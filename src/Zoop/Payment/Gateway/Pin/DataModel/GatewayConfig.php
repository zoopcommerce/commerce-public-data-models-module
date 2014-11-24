<?php

namespace Zoop\Payment\Gateway\Pin\DataModel;

use Zoop\Payment\DataModel\AbstractGatewayConfig;
use Zoop\Payment\DataModel\PinGatewayConfigInterface;
use Zoop\Payment\DataModel\OmnipayTrait;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 */
class GatewayConfig extends AbstractGatewayConfig implements PinGatewayConfigInterface
{
    use OmnipayTrait;

    /**
     *
     * @ODM\String
     */
    protected $secretKey;

    public function getSecretKey()
    {
        return $this->secretKey;
    }

    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return string $type
     */
    public function getType()
    {
        return parent::TYPE_PIN;
    }
}
