<?php

namespace Zoop\Theme\DataModel;

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
class Image extends AbstractFileAsset implements ImageAssetInterface
{
    /**
     * @ODM\String
     */
    protected $src;

    /**
     * @ODM\Int
     */
    protected $height;

    /**
     * @ODM\Int
     */
    protected $width;

    /**
     * @ODM\String
     */
    protected $extension;

    /**
     * @ODM\String
     */
    protected $mime;

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

    /**
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param integer $height
     */
    public function setHeight($height)
    {
        $this->height = (int) $height;
    }

    /**
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param integer $width
     */
    public function setWidth($width)
    {
        $this->width = (int) $width;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }
}
