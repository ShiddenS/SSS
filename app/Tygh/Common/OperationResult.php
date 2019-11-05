<?php
/***************************************************************************
 *                                                                          *
 *   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
 *                                                                          *
 * This  is  commercial  software,  only  users  who have purchased a valid *
 * license  and  accept  to the terms of the  License Agreement can install *
 * and use this program.                                                    *
 *                                                                          *
 ****************************************************************************
 * PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
 * "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
 ****************************************************************************/

namespace Tygh\Common;

use Tygh\Exceptions\OperationException;

/**
 * Class OperationResult
 *
 * @package Tygh\Common
 */
class OperationResult
{
    protected $errors = array();

    protected $warnings = array();

    protected $messages = array();

    protected $success = false;

    protected $data;

    /**
     * OperationResult constructor.
     *
     * @param bool $success
     * @param null $data
     */
    public function __construct($success = false, $data = null)
    {
        $this->setSuccess($success);
        $this->setData($data);
    }

    /**
     * Sets operation data.
     *
     * @param mixed $data
     * @param null|string $key
     * @param null|string $sub_key
     */
    public function setData($data, $key = null, $sub_key = null)
    {
        if ($key === null) {
            $this->data = $data;
        } else {
            if (is_array($this->data)) {
                $this->data = (array) $this->data;
            }

            if ($sub_key === null) {
                $this->data[$key] = $data;
            } else {
                $this->data[$key][$sub_key] = $data;
            }
        }
    }

    /**
     * Gets operation data.
     *
     * @param null|string $key
     * @param null|mixed  $default
     *
     * @return mixed
     */
    public function getData($key = null, $default = null)
    {
        if ($key === null) {
            return $this->data;
        } else {
            return is_array($this->data) && array_key_exists($key, $this->data) ? $this->data[$key] : $default;
        }
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = (bool) $success;
    }

    /**
     * Add error.
     *
     * @param string $code  Error code.
     * @param string $error Error message.
     */
    public function addError($code, $error)
    {
        $this->errors[$code] = $error;
    }

    /**
     * Remove error by error code.
     *
     * @param string $code Error code.
     */
    public function removeError($code)
    {
        unset($this->errors[$code]);
    }

    /**
     * Sets errors.
     *
     * @param array $errors List of errors.
     */
    public function setErrors(array $errors)
    {
        foreach ($errors as $code => $error) {
            $this->addError($code, $error);
        }
    }

    /**
     * Gets errors.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Gets first error.
     *
     * @return string|false
     */
    public function getFirstError()
    {
        return reset($this->errors);
    }

    /**
     * Add message.
     *
     * @param string $code      Message code.
     * @param string $message   Message.
     */
    public function addMessage($code, $message)
    {
        $this->messages[$code] = $message;
    }

    /**
     * Remove message by code.
     *
     * @param string $code  Message code.
     */
    public function removeMessage($code)
    {
        unset($this->messages[$code]);
    }

    /**
     * Sets messages.
     *
     * @param array $messages
     */
    public function setMessages(array $messages)
    {
        foreach ($messages as $code => $message) {
            $this->addMessage($code, $message);
        }
    }

    /**
     * Gets messages.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Add warning.
     *
     * @param string $code      Warning code.
     * @param string $warning   Warning message.
     */
    public function addWarning($code, $warning)
    {
        $this->warnings[$code] = $warning;
    }

    /**
     * Remove warning by code.
     *
     * @param string $code
     */
    public function removeWarning($code)
    {
        unset($this->warnings[$code]);
    }

    /**
     * Sets warnings.
     *
     * @param array $messages
     */
    public function setWarnings(array $messages)
    {
        foreach ($messages as $code => $message) {
            $this->addWarning($code, $message);
        }
    }

    /**
     * Gets warnings.
     *
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * Returns a value indicating whether there is any error
     *
     * @return true
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }
    /**
     * Returns a value indicating whether there is any warning
     *
     * @return true
     */
    public function hasWarnings()
    {
        return !empty($this->warnings);
    }
    /**
     * Returns a value indicating whether there is any message
     *
     * @return true
     */
    public function hasMessages()
    {
        return !empty($this->messages);
    }

    /**
     * Show notifications.
     *
     * @param bool $translate_messages Whether error messages must be translated before display
     *
     * Call fn_set_notification for errors, warnings and messages.
     */
    public function showNotifications($translate_messages = false)
    {
        foreach ($this->errors as $error) {
            if ($translate_messages) {
                $error = __($error);
            }
            fn_set_notification('E', __('error'), $error);
        }

        foreach ($this->warnings as $warning) {
            if ($translate_messages) {
                $warning = __($warning);
            }
            fn_set_notification('W', __('warning'), $warning);
        }

        foreach ($this->messages as $message) {
            if ($translate_messages) {
                $message = __($message);
            }
            fn_set_notification('N', __('successful'), $message);
        }
    }

    /**
     * Throws exception if operation has errors
     *
     * @throws \Tygh\Exceptions\OperationException
     */
    public function throwIfError()
    {
        if ($this->hasErrors()) {
            throw new OperationException(implode(PHP_EOL, $this->errors));
        }
    }

    /**
     * Merges errors, warnings, messages, data from another OperationResult instance
     *
     * @param OperationResult $result
     * @param bool            $merge_data           Whether to merge data
     */
    public function merge(OperationResult $result, $merge_data = false)
    {
        foreach ($result->getWarnings() as $code => $message) {
            $this->addWarning($code, $message);
        }

        foreach ($result->getErrors() as $code => $message) {
            $this->addError($code, $message);
        }

        foreach ($result->getMessages() as $code => $message) {
            $this->addMessage($code, $message);
        }

        if ($merge_data && $result->getData()) {
            $this->setData(array_merge((array) $this->getData(), (array) $result->getData()));
        }
    }
}
