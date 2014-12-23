<?php

namespace Zoop\Entity\DataModel;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

trait EntitiesTrait
{
    /**
     * @ODM\Collection
     * @ODM\Index
     * @Shard\Zones
     */
    protected $entities = [];

    /**
     * @return array
     */
    public function getEntities()
    {
        if (!is_array($this->entities)) {
            $this->entities = [];
        }
        return $this->entities;
    }

    /**
     * @param array $entities
     */
    public function setEntities(array $entities)
    {
        $this->entities = $entities;
    }

    /**
     * @param string $entity
     */
    public function addEntity($entity)
    {
        if (!empty($entity) && in_array($entity, $this->getEntities()) === false) {
            $this->entities[] = $entity;
        }
    }
}
