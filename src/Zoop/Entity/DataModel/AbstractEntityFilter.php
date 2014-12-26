<?php

namespace Zoop\Entity\DataModel;

use Zoop\Entity\DataModel\AbstractEntity;
use Zoop\Entity\DataModel\EntityFilterInterface;
use Zoop\Entity\DataModel\EntitiesTrait;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document(collection="Entities")
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 * @ODM\DiscriminatorField("type")
 * @ODM\DiscriminatorMap({
 *     "Customer"  = "Zoop\Customer\DataModel\Customer",
 *     "Partner"   = "Zoop\Partner\DataModel\Partner",
 *     "Store"     = "Zoop\Store\DataModel\Store"
 * })
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="sys::entity", allow="read")
 * })
 */
abstract class AbstractEntityFilter extends AbstractEntity implements EntitiesFilterInterface
{
    use EntitiesTrait;
}
