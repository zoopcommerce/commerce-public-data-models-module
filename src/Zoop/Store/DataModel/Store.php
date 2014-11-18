<?php

namespace Zoop\Store\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Common\DataModel\AddressInterface;
use Zoop\Common\DataModel\CurrencyInterface;
use Zoop\Shard\Stamp\DataModel\CreatedOnTrait;
use Zoop\Shard\Stamp\DataModel\CreatedByTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedOnTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedByTrait;
use Zoop\Shard\SoftDelete\DataModel\SoftDeleteableTrait;
use Zoop\Store\DataModel\StoreInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="sys::store", allow="read"),
 *     @Shard\Permission\Basic(roles={"zoop::admin", "partner::admin", "company::admin"}, allow="*"),
 *     @Shard\Permission\Basic(roles="store::admin", allow={"read", "update::*"}, deny="delete"),
 *     @Shard\Permission\Basic(roles="owner", allow={"read", "update::*"})
 * })
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 *
 */
class Store implements StoreInterface
{
    use CreatedOnTrait;
    use CreatedByTrait;
    use SoftDeleteableTrait;
    use UpdatedOnTrait;
    use UpdatedByTrait;

    /**
     * @ODM\Id(
     *     strategy="custom",
     *     options={"class"="Zoop\Store\StoreSlugGenerator"}
     * )
     * @Shard\Zones
     */
    protected $slug;

    /**
     * @ODM\String
     * @Shard\Validator\Required
     */
    protected $name;

    /**
     * @ODM\String
     */
    protected $businessName;

    /**
     * @ODM\String
     * @Shard\Validator\Required
     */
    protected $email;

    /**
     * @ODM\String
     */
    protected $salesEmail;

    /**
     * @ODM\String
     */
    protected $description;

    /**
     * @ODM\String
     */
    protected $authorizationCode;

    /**
     * @ODM\String
     */
    protected $googleWebmasterToolsMetaContent;

    /**
     * @ODM\String
     */
    protected $googleAnalyticsTrackingId;

    /**
     * @ODM\String
     */
    protected $facebook;

    /**
     * @ODM\String
     */
    protected $twitter;

    /**
     * @ODM\String
     */
    protected $youtube;

    /**
     * @ODM\String
     */
    protected $instagram;

    /**
     * @ODM\String
     */
    protected $googlePlus;

    /**
     * @ODM\String
     */
    protected $pinterest;

    /**
     * @ODM\String
     * @ODM\Index(unique = true, sparse = true)
     */
    protected $primaryDomain;
    
    /**
     * @ODM\String
     */
    protected $checkoutDomain;

    /**
     * @ODM\Collection
     */
    protected $domains;

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
     * @ODM\EmbedOne(targetDocument="Zoop\Common\DataModel\Address")
     */
    protected $address;

    /**
     * @ODM\String
     */
    protected $phoneNumber;

    /**
     *
     * @ODM\EmbedMany(targetDocument="Zoop\Store\DataModel\RegionalTaxationRule")
     */
    protected $regionalTaxationRules;

    /**
     * @ODM\Boolean
     */
    protected $isMaintenanceMode = false;
    protected $url;
    protected $checkoutUrl;

    /**
     *
     */
    public function __construct()
    {
        $this->currencies = new ArrayCollection();
        $this->regionalTaxationRules = new ArrayCollection();
    }

    /**
     * Alias for getSlug
     * @return string
     */
    public function getId()
    {
        return $this->getSlug();
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPrimaryDomain()
    {
        return $this->primaryDomain;
    }

    /**
     * @param string $domain
     */
    public function setPrimaryDomain($domain)
    {
        $this->primaryDomain = $domain;
    }

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
    public function getDomain()
    {
        $primary = $this->getPrimaryDomain();
        if (!empty($primary)) {
            return $primary;
        }
        return $this->getDomains()[0];
    }

    /**
     * @return array
     */
    public function getDomains()
    {
        return $this->domains;
    }

    /**
     * @param array $domains
     */
    public function setDomains(array $domains)
    {
        $this->domains = $domains;
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
     * @return AddressInterface
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     *
     * @param AddressInterface $address
     */
    public function setAddress(AddressInterface $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     *
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     *
     * @param string $facebook
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     *
     * @param string $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return string
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     *
     * @param string $youtube
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;
    }

    /**
     * @return string
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     *
     * @param string $instagram
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;
    }

    /**
     * @return string
     */
    public function getGooglePlus()
    {
        return $this->googlePlus;
    }

    /**
     *
     * @param string $googlePlus
     */
    public function setGooglePlus($googlePlus)
    {
        $this->googlePlus = $googlePlus;
    }

    /**
     * @return string
     */
    public function getPinterest()
    {
        return $this->pinterest;
    }

    /**
     *
     * @param string $pinterest
     */
    public function setPinterest($pinterest)
    {
        $this->pinterest = $pinterest;
    }

    /**
     * @return string
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     *
     * @param string $authorizationCode
     */
    public function setAuthorizationCode($authorizationCode)
    {
        $this->authorizationCode = $authorizationCode;
    }

    /**
     * @return string
     */
    public function getGoogleWebmasterToolsMetaContent()
    {
        return $this->googleWebmasterToolsMetaContent;
    }

    /**
     *
     * @param string $googleWebmasterToolsMetaContent
     */
    public function setGoogleWebmasterToolsMetaContent($googleWebmasterToolsMetaContent)
    {
        $this->googleWebmasterToolsMetaContent = $googleWebmasterToolsMetaContent;
    }

    /**
     * @return string
     */
    public function getGoogleAnalyticsTrackingId()
    {
        return $this->googleAnalyticsTrackingId;
    }

    /**
     *
     * @param string $googleAnalyticsTrackingId
     */
    public function setGoogleAnalyticsTrackingId($googleAnalyticsTrackingId)
    {
        $this->googleAnalyticsTrackingId = $googleAnalyticsTrackingId;
    }

    /**
     * @return boolean
     */
    public function isMaintenanceMode()
    {
        return $this->isMaintenanceMode;
    }

    /**
     *
     * @param boolean $isMaintenanceMode
     */
    public function setIsMaintenanceMode($isMaintenanceMode)
    {
        $this->isMaintenanceMode = (boolean) $isMaintenanceMode;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
