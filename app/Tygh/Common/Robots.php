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

use Tygh\Registry;

/**
 * Editing robots.txt file
 */
class Robots
{
    public $default = false;
    public $path;

    public function __construct($default = false)
    {
        $this->default = $default;

        $this->path = $this->getPath();
    }

    public function get()
    {
        $content = '';

        if (!empty($this->path) && file_exists($this->path)) {
            $content = file_get_contents($this->path);
        }

        fn_set_hook('robots_get', $this, $content);

        return $content;
    }

    public function save($content)
    {
        $processed = null;

        $this->saveBackup();

        fn_set_hook('robots_save', $this, $processed, $content);

        if (!is_null($processed)) {
            return $processed;
        }

        $res = false;
        if (!empty($this->path)) {
            $res = fn_put_contents($this->path, $content);
        }

        return $res;
    }

    public function restore()
    {
        $default = new self(true);
        $this->save($default->get());
    }

    public function check()
    {
        $result = false;

        if (!empty($this->path)) {
            $result = is_writeable($this->path);
        }

        fn_set_hook('robots_check', $this, $result);

        return $result;
    }

    public function updateViaFtp($content, $settings)
    {
        $this->saveBackup();

        $tmp_file = fn_create_temp_file();
        fn_put_contents($tmp_file, $content);
        $ftp_copy_result = fn_copy_by_ftp($tmp_file, $this->path, $settings);
        fn_rm($tmp_file);

        $status = $ftp_copy_result === true;

        return array($status, $ftp_copy_result);
    }

    /**
     * Adds the robots.txt data to the robots_data table for a newly-created storefront.
     * If the new storefront is cloned from an existing one, the robots.txt data is cloned from that storefront as well;
     * otherwise the data is taken from the first company.
     *
     * @param int   $company_id       The identifier of the company.
     * @param array $clone_company_id The identifier of the clone company.
     *
     * @return void
     */
    public function addRobotsDataForNewCompany($company_id, $clone_company_id = null)
    {
        $data_robots = $this->getRobotsDataByCompanyId($clone_company_id);
        $data = isset($data_robots['data']) ? $data_robots['data'] : '';

        $this->setRobotsDataForCompanyId($company_id, $data);
    }

    /**
     * Gets the data of robots from the robots_data table for a storefront with the specified company identifier.
     *
     * @param int $company_id The identifier of the company.
     *
     * @return array The array of robots data from the robots_data table.
     */
    public function getRobotsDataByCompanyId($company_id)
    {
        if (fn_allowed_for('ULTIMATE') && empty($company_id) && !Registry::get('runtime.simple_ultimate')) {
            $company_id = fn_get_default_company_id();
        }

        $robots_data = db_get_row('SELECT robots_id, data FROM ?:robots_data WHERE company_id = ?i', $company_id);

        return $robots_data;
    }

    /**
     * Adds an entry with the robots.txt data for a storefront with the specified company_id to the robots_data table;
     * updates the entry with the specified company_id, if it already exists in the robots_data table.
     *
     * @param int    $company_id The identifier of the company.
     * @param string $content    The content of robots.
     *
     * @return void
     */
    public function setRobotsDataForCompanyId($company_id, $content)
    {
        $data = array(
            'company_id' => $company_id,
            'data' => $content
        );

        $robots_data = $this->getRobotsDataByCompanyId($company_id);
        if (!empty($robots_data['robots_id'])) {
            $data['robots_id'] = $robots_data['robots_id'];
        }

        db_replace_into('robots_data', $data);
    }

    /**
     * Gets the content of the robots.txt file, if it exists. Returns void otherwise.
     *
     * @return string|void Returns the content of the robots.txt file.
     */
    public function getRobotsTxtContent()
    {
        $robots_path = $this->getPath();

        if (!file_exists($robots_path)) {
            return null;
        }

        $content = file_get_contents($robots_path);

        return $content;
    }

    /**
     * Deletes an entry with the specified company_id from the robots_data table.
     *
     * @param int  $company_id The identifier of the company.
     *
     * @return void
     */
    public function deleteRobotsDataByCompanyId($company_id)
    {
        db_query('DELETE FROM ?:robots_data WHERE company_id = ?i', $company_id);
    }

    protected function getPath()
    {
        $path = Registry::get('config.dir.root');
        if ($this->default) {
            $path .= '/var';
        }
        $path .= '/robots.txt';

        fn_set_hook('robots_get_path', $this, $path);

        return $path;
    }

    protected function saveBackup()
    {
        if (!$this->default) {
            $default = new self(true);
            $default_content = $default->get();
            if (empty($default_content)) { // It first update, need to save original
                $default->save($this->get());
            }
        }
    }
}
