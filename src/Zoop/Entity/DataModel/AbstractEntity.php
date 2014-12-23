<?php

namespace Zoop\Entity\DataModel;

use Zoop\Common\DataModel\AddressInterface;
use Zoop\Common\DataModel\SocialInterface;
use Zoop\Shard\Stamp\DataModel\CreatedOnTrait;
use Zoop\Shard\Stamp\DataModel\CreatedByTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedOnTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedByTrait;
use Zoop\Shard\SoftDelete\DataModel\SoftDeleteableTrait;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document(collection="Entities")
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 * @ODM\DiscriminatorField("type")
 * @ODM\DiscriminatorMap({
 *     "Customer"  = "Zoop\Customer\DataModel\Customer",
 *     "Partner"   = "Zoop\Partner\DataModel\Partner",
 *     "Store"     = "Zoop\Store\DataModel\Store"
 * })
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="sys::entity", allow="read")
 * })
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
abstract class AbstractEntity implements EntityInterface
{
    use CreatedOnTrait;
    use CreatedByTrait;
    use SoftDeleteableTrait;
    use UpdatedOnTrait;
    use UpdatedByTrait;

    /**
     * @ODM\Id(
     *     strategy="custom",
     *     options={"class"="Zoop\Entity\EntitySlugGenerator"}
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
     * @Shard\Validator\Required
     */
    protected $email;

    /**
     * @ODM\EmbedOne(targetDocument="Zoop\Common\DataModel\Address")
     */
    protected $address;

    /**
     * @ODM\String
     */
    protected $phoneNumber;

    /**
     * @ODM\String
     */
    protected $description;

    /**
     * @ODM\EmbedOne(targetDocument="Zoop\Common\DataModel\Social")
     */
    protected $social;

    /**
     * @ODM\String
     * @ODM\Index(unique = true, sparse = true)
     */
    protected $primaryDomain;

    /**
     * @ODM\Collection
     */
    protected $domains;

    /**
     * @ODM\String
     */
    protected $authorizationCode;

    /**
     * @ODM\String
     */
    protected $googleAnalyticsTrackingId;

    /**
     * @ODM\Boolean
     */
    protected $isMaintenanceMode = false;

    /**
     * @ODM\Boolean
     */
    protected $isActive = true;

    /**
     * @ODM\Boolean
     */
    protected $canDisplay = true;
    protected $url;

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
     * @return SocialInterface
     */
    public function getSocial()
    {
        return $this->social;
    }

    /**
     * @param SocialInterface $social
     */
    public function setSocial(SocialInterface $social)
    {
        $this->social = $social;
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
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
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
    public function getGoogleAnalyticsTrackingId()
    {
        return $this->googleAnalyticsTrackingId;
    }

    /**
     * @param string $googleAnalyticsTrackingId
     */
    public function setGoogleAnalyticsTrackingId($googleAnalyticsTrackingId)
    {
        $this->googleAnalyticsTrackingId = $googleAnalyticsTrackingId;
    }

    /**
     * @return string
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     * @param string $authorizationCode
     */
    public function setAuthorizationCode($authorizationCode)
    {
        $this->authorizationCode = $authorizationCode;
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
     * @return boolean
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = (boolean) $isActive;
    }

    /**
     * @return boolean
     */
    public function canDisplay()
    {
        return $this->canDisplay;
    }

    /**
     * @param boolean $canDisplay
     */
    public function setCanDisplay($canDisplay)
    {
        $this->canDisplay = (boolean) $canDisplay;
    }
}
