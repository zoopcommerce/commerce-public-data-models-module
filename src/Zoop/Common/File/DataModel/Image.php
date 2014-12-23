<?php

namespace Zoop\Common\File\DataModel;

use Zoop\Common\DataModel\UrlInterface;
use Zoop\Common\File\DataModel\ImageInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Image implements ImageInterface
{
    /**
     * @ODM\Id(strategy="UUID")
     */
    protected $id;

    /**
     * @ODM\Int
     * @ODM\Index(unique = true)
     */
    protected $legacyId;

    /**
     * @ODM\String
     */
    protected $alt;

    /**
     * @ODM\String
     */
    protected $mime;

    /**
     * @ODM\String
     */
    protected $extension;

    /**
     * @ODM\Int
     */
    protected $height;

    /**
     * @ODM\Int
     */
    protected $width;

    /**
     * @ODM\EmbedOne(targetDocument="Zoop\Common\DataModel\Url")
     * @Shard\Validator\Required
     */
    protected $url;

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     */
    public function setAlt($alt)
    {
        $this->alt = (string) $alt;
    }

    /**
     * @return string
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * @param string $mime
     */
    public function setMime($mime)
    {
        $this->mime = (string) $mime;
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
        $this->height = (integer) $height;
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
        $this->width = (integer) $width;
    }

    /**
     * @return UrlInterface
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param UrlInterface $url
     */
    public function setUrl(UrlInterface $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
