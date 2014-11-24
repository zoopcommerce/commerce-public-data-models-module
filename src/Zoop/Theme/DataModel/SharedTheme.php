<?php

namespace Zoop\Theme\DataModel;

use Zoop\Theme\DataModel\SharedThemeInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class SharedTheme extends AbstractTheme implements SharedThemeInterface
{

}
