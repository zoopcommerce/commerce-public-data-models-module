<?php

namespace Zoop\Store\DataModel;

use Zoop\Entity\DataModel\AbstractEntityFilter;
use Zoop\Common\DataModel\CurrencyInterface;
use Zoop\Store\DataModel\StoreInterface;
use Doctrine\Common\Collections\ArrayCollection;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles={"sys::entity", "sys::store"}, allow="read"),
 *     @Shard\Permission\Basic(roles={"zoop::admin", "partner::admin", "company::admin"}, allow="*"),
 *     @Shard\Permission\Basic(roles="store::admin", allow={"read", "update::*"}, deny={"delete", "update::softDeleted", "update::entities"}),
 *     @Shard\Permission\Basic(roles="owner", allow={"read", "update::*"})
 * })
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 *
 */
class Store extends AbstractEntityFilter implements StoreInterface
{
    /**
     * @ODM\String
     */
    protected $businessName;

    /**
     * @ODM\String
     */
    protected $salesEmail;

    /**
     * @ODM\String
     */
    protected $googleWebmasterToolsMetaContent;

    /**
     * @ODM\String
     */
    protected $checkoutDomain;

    /**
     * @ODM\Int
     * @ODM\Index(unique = true)
     */
    protected $legacyId;

    /**
     *
     * @ODM\EmbedMany(targetDocument="Zoop\Common\DataModel\Currency")
     */
    protected $currencies;


    /**
     *
     * @ODM\EmbedMany(targetDocument="Zoop\Store\DataModel\RegionalTaxationRule")
     */
    protected $regionalTaxationRules;
    protected $checkoutUrl;

    /**
     * @return string
     */
    public function getCheckoutDomain()
    {
        return $this->checkoutDomain;
    }

    /**
     * @param string $checkoutDomain
     */
    public function setCheckoutDomain($checkoutDomain)
    {
        $this->checkoutDomain = $checkoutDomain;
    }

    /**
     * @return string
     */
    public function getLegacyId()
    {
        return $this->legacyId;
    }

    /**
     * @param int $legacyId
     */
    public function setLegacyId($legacyId)
    {
        $this->legacyId = (int) $legacyId;
    }

    /**
     * @return array
     */
    public function getCurrencies()
    {
        if (!isset($this->currencies)) {
            $this->currencies = new ArrayCollection();
        }
        return $this->currencies;
    }

    /**
     * @param array $currencies
     */
    public function setCurrencies($currencies)
    {
        if (is_array($currencies)) {
            $this->currencies = new ArrayCollection($currencies);
        } else {
            $this->currencies = $currencies;
        }
    }

    /**
     * @param CurrencyInterface $currency
     */
    public function addCurrency(CurrencyInterface $currency)
    {
        $this->currencies->add($currency);
    }

    /**
     * @return string
     */
    public function getBusinessName()
    {
        return $this->businessName;
    }

    /**
     *
     * @param string $businessName
     */
    public function setBusinessName($businessName)
    {
        $this->businessName = $businessName;
    }

    /**
     * @return string
     */
    public function getSalesEmail()
    {
        return $this->salesEmail;
    }

    /**
     *
     * @param string $salesEmail
     */
    public function setSalesEmail($salesEmail)
    {
        $this->salesEmail = $salesEmail;
    }

    /**
     * @return array
     */
    public function getRegionalTaxationRules()
    {
        if (!isset($this->regionalTaxationRules)) {
            $this->regionalTaxationRules = new ArrayCollection();
        }
        return $this->regionalTaxationRules;
    }

    /**
     *
     * @param array $regionalTaxationRules
     */
    public function setRegionalTaxationRules($regionalTaxationRules)
    {
        if (is_array($regionalTaxationRules)) {
            $this->regionalTaxationRules = new ArrayCollection($regionalTaxationRules);
        } else {
            $this->regionalTaxationRules = $regionalTaxationRules;
        }
    }

    /**
     *
     * @param string $countryCode
     * @param RegionalTaxationRuleInterface $regionTaxationRule
     */
    public function addRegionalTaxationRule($countryCode, RegionalTaxationRuleInterface $regionTaxationRule)
    {
        $this->regionalTaxationRules[$countryCode] = $regionTaxationRule;
    }

    /**
     * @return string
     */
    public function getCheckoutUrl()
    {
        return $this->checkoutUrl;
    }

    /**
     * @param string $checkoutUrl
     */
    public function setCheckoutUrl($checkoutUrl)
    {
        $this->checkoutUrl = $checkoutUrl;
    }
}
