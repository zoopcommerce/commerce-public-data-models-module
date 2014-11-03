<?php

namespace Zoop\Payment\Gateway\Stripe\DataModel;

use Zoop\Payment\DataModel\AbstractGatewayConfig;
use Zoop\Payment\DataModel\StripeGatewayConfigInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 */
class GatewayConfig extends AbstractGatewayConfig implements StripeGatewayConfigInterface
{
    /**
     *
     * @ODM\String
     */
    protected $apiKey;

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string $type
     */
    public function getType()
    {
        return parent::TYPE_STRIPE;
    }
}
