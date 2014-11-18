<?php

namespace Zoop\Store\DataModel;

use Zoop\Common\DataModel\TaxationRuleInterface;
use Zoop\Common\DataModel\RegionInterface;
use Zoop\Store\DataModel\RegionalTaxationRuleInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class RegionalTaxationRule implements RegionalTaxationRuleInterface
{
    /**
     * @ODM\EmbedOne(targetDocument="Zoop\Common\DataModel\TaxationRule")
     */
    protected $taxationRule;

    /**
     * @ODM\String
     */
    protected $country;
    //these aren't used just yet. We will have to create a region collection that links to a country
    protected $region;
    protected $postcode;

    /**
     *
     * @return TaxationRuleInterface
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     *
     * @param TaxationRuleInterface $tax
     */
    public function setTax(TaxationRuleInterface $tax)
    {
        $this->taxationRule = $tax;
    }

    /**
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     *
     * @return RegionInterface
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     *
     * @param RegionInterface $region
     */
    public function setRegion(RegionInterface $region)
    {
        $this->region = $region;
    }

    /**
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     *
     * @param string $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }
}
