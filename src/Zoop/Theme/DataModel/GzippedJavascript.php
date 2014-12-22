<?php

namespace Zoop\Theme\DataModel;

use Zoop\Theme\DataModel\FileAssetInterface;
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
class GzippedJavascript extends AbstractFileAsset implements FileAssetInterface
{
    /**
     * @ODM\String
     */
    protected $src;

    /**
     * @ODM\String
     * @Shard\Unserializer\Ignore
     */
    protected $mime = 'application/javascript';

    /**
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @param string $src
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }
}
