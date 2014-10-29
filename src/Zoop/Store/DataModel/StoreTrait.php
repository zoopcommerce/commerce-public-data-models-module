<?php

namespace Zoop\Store\DataModel;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

trait StoreTrait
{
    /**
     * @ODM\String
     * @ODM\Index
     * @Shard\Zones
     */
    protected $store;

    /**
     * @return string
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param string $store
     */
    public function setStore($store)
    {
        $this->store = (string) $store;
    }
}
