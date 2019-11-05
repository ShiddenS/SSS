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


namespace Tygh\Commerceml\Dto\Offers;


class Offer
{
    /** @var string */
    protected $uid;

    /** @var string */
    protected $name;

    /** @var string */
    protected $code;

    /** @var int */
    protected $amount;

    /** @var array */
    protected $image;

    /** @var array */
    protected $prices = [];

    /** @var string|int */
    protected $local_id;

    /** @var \Tygh\Commerceml\Dto\Offers\OfferFeatureValue[]  */
    protected $feature_values = [];

    /** @var \Tygh\Commerceml\Dto\Offers\OfferFeature[] */
    protected $features = [];

    public function addFeatureValue(OfferFeatureValue $feature_value)
    {
        $feature = OfferFeature::createFromFeatureValue($feature_value);
        $this->addFeature($feature);

        $this->feature_values[$feature_value->getFeatureUid()] = $feature_value;
    }

    public function addFeature(OfferFeature $feature)
    {
        $this->features[$feature->getUid()] = $feature;
    }

    /**
     * @return \Tygh\Commerceml\Dto\Offers\OfferFeatureValue[]
     */
    public function getFeatureValues()
    {
        return $this->feature_values;
    }

    /**
     * @param string $feature_uid
     *
     * @return \Tygh\Commerceml\Dto\Offers\OfferFeatureValue|null
     */
    public function getFeatureValue($feature_uid)
    {
        return $this->hasFeatureValue($feature_uid) ? $this->feature_values[$feature_uid] : null;
    }

    /**
     * @param string $feature_uid
     *
     * @return bool
     */
    public function hasFeatureValue($feature_uid)
    {
        return isset($this->feature_values[$feature_uid]);
    }

    /**
     * @param string $feature_uid
     *
     * @return \Tygh\Commerceml\Dto\Offers\OfferFeature|null
     */
    public function getFeature($feature_uid)
    {
        return isset($this->features[$feature_uid]) ? $this->features[$feature_uid] : null;
    }

    /**
     * Gets feature uid list
     *
     * @return string[]
     */
    public function getFeatureUids()
    {
        return array_keys($this->features);
    }

    /**
     * @return \Tygh\Commerceml\Dto\Offers\OfferFeature[]
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return array
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param array $prices
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;
    }

    /**
     * @return int|string
     */
    public function getLocalId()
    {
        return $this->local_id;
    }

    /**
     * @param int|string $local_id
     */
    public function setLocalId($local_id)
    {
        $this->local_id = $local_id;
    }

    /**
     * @return array
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param array $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
}
