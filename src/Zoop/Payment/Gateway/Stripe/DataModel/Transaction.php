<?php

namespace Zoop\Payment\Gateway\Stripe\DataModel;

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
    protected $id;

    /**
     * @return string $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
