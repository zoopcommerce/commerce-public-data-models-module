<?php

namespace Zoop\User\DataModel;

use Zoop\User\DataModel\AbstractUser;
use Zoop\Entity\DataModel\EntitiesFilterInterface;
use Zoop\Entity\DataModel\EntitiesTrait;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

class AbstractUserFilter extends AbstractUser implements EntitiesFilterInterface
{
    use EntitiesTrait;
}
