<?php
/**
 *
 *  * This file is part of Boxberry Api.
 *  *
 *  * (c) 2016, T. I. R. Ltd.
 *  * Evgeniy Mosunov, Alexander Borovikov
 *  *
 *  * For the full copyright and license information, please view LICENSE
 *  * file that was distributed with this source code
 *  *
 *  * File: WidgetSettings.php
 *  * Created: 26.07.2016
 *  *
 */

namespace Boxberry\Collections;

use Boxberry\Collections\Exceptions\BadValueException;
use Boxberry\Models\WidgetSetting;

/**
 * Class WidgetSettings
 * @package Boxberry\Collections
 */
class WidgetSettings extends Collection
{
    /**
     * Items constructor.
     * @param array $data
     */
    public function __construct($data = null)
    {
		if (is_array($data['result'])&&!empty($data['result'])) {
            foreach ($data['result'] as $key => $settings_group)
            {
				foreach($settings_group as $setting_name=>$setting_val)
				{
					$settings[$setting_name]=$setting_val;
				}
				
			}
			$this->offsetSet(null, new WidgetSetting($settings));
		}
	
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @throws BadValueException
     */
    public function offsetSet($offset, $value)
    {
        if (!$value instanceof WidgetSetting) {
            throw new BadValueException();
        }
		
		
        if (is_null($offset)) {
            $this->_container[] = $value;
        } else {
            $this->_container[$offset] = $value;
        }
		
    }

}