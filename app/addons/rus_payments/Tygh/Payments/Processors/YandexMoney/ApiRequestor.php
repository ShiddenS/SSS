<?php

namespace Tygh\Payments\Processors\YandexMoney;

use Tygh\Payments\Processors\YandexMoney\Exception as Exceptions;

/**
 *
 */
class ApiRequestor
{
    /**
     *
     */
    const USER_AGENT = 'yandex-money-sdk-php';

    /**
     *
     */
    const CERTIFICATE_PATH = '/../data/ca-certificate.crt';

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $logFile;

    /**
     * @param string $accessToken
     * @param string $logFile
     */
    public function __construct($accessToken = null, $logFile = null)
    {
        $this->accessToken = $accessToken;
        $this->logFile = $logFile;
    }

    /**
     * @param  string $uri
     * @param  string $params
     * @return array
     */
    public function request($uri, $params = null, $expectResponseBody = true)
    {
        list($rbody, $rcode) = $this->_curlRequest($uri, $params);

        return $this->_interpretResponse($rbody, $rcode, $expectResponseBody);
    }

    /**
     * @param  string $uri
     * @param  string $params
     * @return array
     */
    private function _curlRequest($uri, $params)
    {
        $curl = curl_init($uri);

        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8;';
        if ($this->accessToken) {
            $headers[] = 'Authorization: Bearer ' . $this->accessToken;
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($curl, CURLOPT_USERAGENT, self::USER_AGENT);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_TIMEOUT, 80);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . self::CERTIFICATE_PATH);

        $this->_log($this->_makeRequestLogMessage($uri, $params));

        $rbody = curl_exec($curl);

        $errno = curl_errno($curl);
        $error = curl_error($curl);
        $rcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->_log($this->_makeResponseLogMessage($uri, $params, $rcode, $errno, $error));

        if ($rbody === false) {
            $this->_handleCurlError($errno, $error);
        }

        return array($rbody, $rcode);
    }

    /**
     * @param  string $rbody
     * @param  int    $rcode
     * @return array  $response
     *
     * @throws \Tygh\Payments\Processors\YandexMoney\Exception\ApiException
     */
    private function _interpretResponse($rbody, $rcode, $expectResponseBody)
    {
        if ($rcode < 200 || $rcode >= 300) {
            $this->_handleApiError($rbody, $rcode, $expectResponseBody);
        }

        try {
            $resp = json_decode($rbody, true);
        } catch (Exception $e) {
            throw new Exceptions\ApiException("Invalid response body from API: $rbody (HTTP response code was $rcode)", $rcode, $rbody);
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new YM_ApiError("Json parsing error with json_last_error code = " . json_last_error(), $rcode, $rbody);
        }

        if ($resp === null && $expectResponseBody) {
            throw new Exceptions\ApiException("Server response body is null: $rbody (HTTP response code was $rcode)", $rcode, $rbody);
        }

        return $resp;
    }

    /**
     * @param int    $errno
     * @param string $message
     *
     * @throws \Tygh\Payments\Processors\YandexMoney\Exception\ApiConnectionException
     */
    private function _handleCurlError($errno, $message)
    {
        switch ($errno) {
            case CURLE_COULDNT_CONNECT:
            case CURLE_COULDNT_RESOLVE_HOST:
            case CURLE_OPERATION_TIMEOUTED:
                $msg = "Could not connect to Yandex.Money. Please check your internet connection and try again.";
                break;
            case CURLE_SSL_CACERT:
            case CURLE_SSL_PEER_CERTIFICATE:
                $msg = "Could not verify Yandex.Money's SSL certificate. Please make sure that your network is not intercepting certificates.";
                break;
            default:
                $msg = "Unexpected error communicating with Yandex.Money.";
        }

        $msg .= "\n\n(Network error: $message)";

        throw new Exceptions\ApiConnectionException($msg);
    }

    /**
     * @param string $rbody
     * @param string $rcode
     * @param string $resp
     *
     * @throws \Tygh\Payments\Processors\YandexMoney\Exception\ApiException
     * @throws \Tygh\Payments\Processors\YandexMoney\Exception\InvalidTokenException
     * @throws \Tygh\Payments\Processors\YandexMoney\Exception\InsufficientScopeException
     * @throws \Tygh\Payments\Processors\YandexMoney\Exception\InternalServerErrorException
     */
    private function _handleApiError($rbody, $rcode, $resp)
    {
        switch ($rcode) {
            case 400:
                throw new Exceptions\ApiException('Invalid request error', $rcode, $rbody, $resp);
            case 401:
                throw new Exceptions\InvalidTokenException('Nonexistent, expired, or revoked token specified.', $rcode, $rbody, $resp);
            case 403:
                throw new Exceptions\InsufficientScopeException('The token does not have permissions for the requested operation.',
                    $rcode, $rbody, $resp);
            case 500:
                throw new Exceptions\InternalServerErrorException('It is a technical error occurs, the server responds with the HTTP code
                    500 Internal Server Error. The application should repeat the request with the same parameters later.',
                    $rcode, $rbody, $resp);
            default:
                throw new Exceptions\ApiException('Unknown API response error. You should inform your software developer.',
                    $rcode, $rbody, $resp);
        }
    }

    /**
     * @param string $message
     *
     * @throws \Tygh\Payments\Processors\YandexMoney\Exception\Exception
     */
    private function _log($message)
    {
        $f = $this->logFile;
        if ($f !== null) {
            if (file_exists($f)) {
                if (!is_file($f)) {
                    throw new Exceptions\Exception("log file $f is not a file");
                }
                if (!is_writable($f)) {
                    throw new Exceptions\Exception("log file $f is not writable");
                }
            }

            if (!$handle = fopen($f, 'a')) {
                throw new Exceptions\Exception("couldn't open log file $f for appending");
            }

            $time = '[' . date("Y-m-d H:i:s") . '] ';
            if (fwrite($handle, $time . $message . "\r\n") === false) {
                throw new Exceptions\Exception("couldn't fwrite message log to $f");
            }

            fclose($handle);
        }
    }

    /**
     * @param string $uri
     * @param string $params
     *
     * @return string
     */
    private function _makeRequestLogMessage($uri, $params)
    {
        if ($this->logFile === null) {
            return '';
        }

        $m = "request: " . $uri . '; ';

        $token = $this->accessToken;
        if (isset($token)) {
            $m = $m . 'token = *' . substr($token, -4) . '; ';
        }

        parse_str($params, $parse_result);

        if (isset($parse_result['to'])) {
            $m = $m . 'param to = *' . substr($parse_result['to'], -4) . '; ';
        }

        if (isset($parse_result['pattern_id'])) {
            $m = $m . 'param pattern_id = ' . $parse_result['pattern_id'] . '; ';
        }

        if (isset($parse_result['request_id'])) {
            $m = $m . 'param request_id = *' . substr($parse_result['request_id'], -4) . '; ';
        }

        return $m;
    }

    /**
     * @param string $uri
     * @param string $params
     * @param int    $code
     * @param int    $errno
     * @param string $error
     *
     * @return string
     */
    private function _makeResponseLogMessage($uri, $params, $code, $errno, $error)
    {
        if ($this->logFile === null) {
            return '';
        }

        $m = $this->_makeRequestLogMessage($uri, $params);
        $m = str_replace('request: ', 'response: ', $m);
        $m = $m . "http_code = $code; curl_errno = $errno; curl_error = $error";

        return $m;
    }
}
