<?php

namespace Zoop\Theme\DataModel;

use Zoop\Theme\DataModel\ContentAssetInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="sys::theme", allow="read"),
 *     @Shard\Permission\Basic(roles={"zoop::admin", "partner::admin", "company::admin", "store::admin", "owner"}, allow="*")
 * })
 */
class Less extends AbstractContentAsset implements ContentAssetInterface
{

}
