<?php

namespace Zoop\Theme\DataModel;

use Zoop\Theme\DataModel\CssAssetInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="sys::theme", allow="read"),
 *     @Shard\Permission\Basic(roles={
 *          "zoop::admin",
 *          "partner::admin",
 *          "company::admin",
 *          "store::admin",
 *          "owner"
 *      }, allow="*")
 * })
 */
class Css extends AbstractContentAsset implements CssAssetInterface
{
    /**
     * @ODM\String
     */
    protected $href;

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     */
    public function setHref($href)
    {
        $this->href = $href;
    }
}
