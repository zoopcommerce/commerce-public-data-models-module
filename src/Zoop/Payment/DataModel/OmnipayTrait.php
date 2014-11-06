<?php
namespace Zoop\Payment\DataModel;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

trait OmnipayTrait
{
    /**
     *
     * @ODM\Boolean
     */
    protected $isTestMode = false;
    
    /**
     * @return boolean
     */
    public function isTestMode()
    {
        return $this->isTestMode;
    }
    
    /**
     * @param boolean $isTestMode
     */
    public function setTestMode($testMode)
    {
        $this->isTestMode = $testMode;
    }
}
