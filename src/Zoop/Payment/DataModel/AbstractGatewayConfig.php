<?php

namespace Zoop\Payment\DataModel;

use Zoop\Store\DataModel\StoresTrait;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Shard\Stamp\DataModel\CreatedOnTrait;
use Zoop\Shard\Stamp\DataModel\CreatedByTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedOnTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedByTrait;
use Zoop\Shard\SoftDelete\DataModel\SoftDeleteableTrait;
use Zoop\Store\DataModel\StoreTrait;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document(collection="PaymentGateway")
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 * @ODM\DiscriminatorField(fieldName="type")
 * @ODM\DiscriminatorMap({
 *     "PayPal_Express" = "Zoop\Payment\Gateway\PayPal\Express\DataModel\GatewayConfig",
 *     "Pin"            = "Zoop\Payment\Gateway\Pin\DataModel\GatewayConfig",
 *     "Stripe"         = "Zoop\Payment\Gateway\Stripe\DataModel\GatewayConfig"
 * })
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow={"read", "create", "update::*"}),
 *     @Shard\Permission\Basic(
 *          roles={
 *              "zoop::admin",
 *              "partner::admin",
 *              "company::admin",
 *              "store::admin"
 *          },
 *          allow="delete"
 *     ),
 * });
 */
abstract class AbstractGatewayConfig
{
    const TYPE_PAYPAL_EXPRESS = 'PayPal_Express';
    const TYPE_STRIPE = 'Stripe';
    const TYPE_PIN = 'Pin';
    
    use CreatedOnTrait;
    use CreatedByTrait;
    use UpdatedOnTrait;
    use UpdatedByTrait;
    use StoreTrait;
    use SoftDeleteableTrait;

    /**
     * @ODM\Id(strategy="UUID")
     */
    protected $id;

    /**
     *
     * @ODM\Int
     */
    protected $legacyId;

    /**
     *
     * @ODM\String
     */
    protected $label;

    /**
     *
     * @ODM\Collection
     */
    protected $countries;

    /**
     *
     * @ODM\String
     */
    protected $currency;

    public function __construct()
    {
        $this->countries = [];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLegacyId()
    {
        return $this->legacyId;
    }

    /**
     * Adds a legacy id
     *
     * @param int $legacyId
     */
    public function setLegacyId($legacyId)
    {
        $this->legacyId = (int) $legacyId;
    }

    /**
     * The label to display to the customer in the checkout
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Sets the label that the customer will see in
     * the checkout
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return ArrayCollection
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * @param ArrayCollection $countries
     */
    public function setCountries(array $countries)
    {
        $this->countries = $countries;
    }

    /**
     * 2 letter country code
     *
     * @param string $country
     */
    public function addCountry($country)
    {
        $this->countries[] = $country;
    }

    /**
     * The currency using on payment
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * 3 letter currency code
     *
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    abstract public function getType();
}
