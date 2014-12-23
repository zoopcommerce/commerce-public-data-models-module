<?php

namespace Zoop\User\DataModel;

use Zoop\User\DataModel\AbstractUser;
use Zoop\Entity\DataModel\EntityFilterInterface;
use Zoop\Entity\DataModel\EntitiesTrait;

class AbstractUserFilter extends AbstractUser implements EntityFilterInterface
{
    use EntitiesTrait;
}
