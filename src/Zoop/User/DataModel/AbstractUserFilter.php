<?php

namespace Zoop\User\DataModel;

use Zoop\User\DataModel\AbstractUser;
use Zoop\Entity\DataModel\EntitiesFilterInterface;
use Zoop\Entity\DataModel\EntitiesTrait;

class AbstractUserFilter extends AbstractUser implements EntitiesFilterInterface
{
    use EntitiesTrait;
}
