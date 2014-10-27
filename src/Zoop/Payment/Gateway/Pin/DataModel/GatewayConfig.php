<?php

namespace Zoop\Payment\Gateway\Pin\DataModel;

use Zoop\Payment\DataModel\AbstractGatewayConfig;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;
use Zoop\Payment\DataModel\PinGatewayConfigInterface;

/**
 * @ODM\Document
 */
class GatewayConfig extends AbstractGatewayConfig implements PinGatewayConfigInterface
{
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
}
