<?php

namespace Zoop\Payment\DataModel;

use Zoop\Shard\Stamp\DataModel\CreatedOnTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedOnTrait;
use Zoop\Payment\DataModel\TransactionInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
abstract class AbstractTransaction implements TransactionInterface
{
    use CreatedOnTrait;
    use UpdatedOnTrait;

    /**
     *
     * @ODM\Boolean
     */
    protected $isComplete = false;

    /**
     *
     * @ODM\Boolean
     */
    protected $isWaiting = false;

    /**
     *
     * @ODM\Float
     */
    protected $amount;

    /**
     *
     * @ODM\String
     */
    protected $currency;
    
    /**
     *
     * @ODM\Boolean
     */
    protected $isSuccess = false;
    
    /**
     *
     * @ODM\String
     */
    protected $description;
    
    /**
     *
     * @ODM\String
     */
    protected $errorMessage;
    
    /**
     *
     * @ODM\String
     */
    protected $errorCode;
    
    /**
     *
     * @return boolean
     */
    public function isComplete()
    {
        return $this->isComplete;
    }

    /**
     *
     * @return boolean
     */
    public function isWaiting()
    {
        return $this->isWaiting;
    }

    /**
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     *
     * @param boolean $isComplete
     */
    public function setIsComplete($isComplete)
    {
        $this->isComplete = (boolean) $isComplete;
    }

    /**
     *
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = (float) $amount;
    }

    /**
     *
     * @param boolean $isWaiting
     */
    public function setIsWaiting($isWaiting)
    {
        $this->isWaiting = (boolean) $isWaiting;
    }

    /**
     * @return $currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return boolean $isSuccess
     */
    public function isSuccess()
    {
        return $this->isSuccess;
    }

    /**
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string $errorMessage
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return string $errorCode
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
    
    /**
     * @param boolean $isSuccess
     */
    public function setIsSuccess($isSuccess)
    {
        $this->isSuccess = $isSuccess;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * @param string $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }
    
    /**
     * @param string $errorCode
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }
}
