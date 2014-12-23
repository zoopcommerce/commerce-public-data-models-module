<?php

namespace Zoop\Partner\DataModel;

use Zoop\Partner\DataModel\PartnerInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @author Josh Stuart <josh.stuart@zoopcommerce.com>
 *
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="zoop::admin", allow="*"),
 *     @Shard\Permission\Basic(roles="partner::admin", deny="*"),
 *     @Shard\Permission\Basic(roles="company::admin", deny="*")
 * })
 */
class Partner extends AbstractEntity implements PartnerInterface
{

}