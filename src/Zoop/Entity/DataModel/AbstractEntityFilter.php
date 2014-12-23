<?php

namespace Zoop\Entity\DataModel;

use Zoop\Entity\DataModel\AbstractEntity;
use Zoop\Entity\DataModel\EntityFilterInterface;
use Zoop\Entity\DataModel\EntitiesTrait;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

abstract class AbstractEntityFilter extends AbstractEntity implements EntityFilterInterface
{
    use EntitiesTrait;
}
