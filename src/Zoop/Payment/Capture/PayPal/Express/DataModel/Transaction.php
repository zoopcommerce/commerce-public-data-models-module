<?php

namespace Zoop\Payment\Capture\PayPal\Express\DataModel;

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
     *
     * @ODM\String
     */
    protected $status;

    /**
     *
     * @ODM\String
     */
    protected $pendingReason;

    /**
     *
     * @ODM\String
     */
    protected $transactionReference;

    /**
     *
     * @ODM\Float
     */
    protected $amount;

    /**
     * @return the $transactionReference
     */
    public function getTransactionReference()
    {
        return $this->transactionReference;
    }

    /**
     * @param string $transactionReference
     */
    public function setTransactionReference($transactionReference)
    {
        $this->transactionReference = $transactionReference;
    }

    /**
     * @return the $amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return the $id
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

    /**
     * @return the $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return the $pendingReason
     */
    public function getPendingReason()
    {
        return $this->pendingReason;
    }

    /**
     * @param string $pendingReason
     */
    public function setPendingReason($pendingReason)
    {
        $this->pendingReason = $pendingReason;
    }
}
