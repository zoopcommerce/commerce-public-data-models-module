<?php

namespace Zoop\Entity\DataModel;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

trait EntityTrait
{
    /**
     * @ODM\String
     * @ODM\Index
     * @Shard\Zones
     */
    protected $entity;

    /**
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param string $entity
     */
    public function setEntity($entity)
    {
        $this->entity = (string) $entity;
    }
}
