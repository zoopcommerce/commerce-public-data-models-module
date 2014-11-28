<?php

namespace Zoop\Payment\Gateway\PayPal\Express\DataModel;

use Zoop\Payment\DataModel\AbstractTransaction;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Transaction extends AbstractTransaction
{
    /**
     *
     * @ODM\String
     */
    protected $token;
    
    /**
     * @return string $token
     */
    public function getToken()
    {
        return $this->token;
    }
    
    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
}
