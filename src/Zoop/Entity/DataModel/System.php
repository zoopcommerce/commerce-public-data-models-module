<?php

namespace Zoop\Entity\DataModel;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="sys::entity", allow="read")
 * })
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class System extends AbstractEntity
{

}
