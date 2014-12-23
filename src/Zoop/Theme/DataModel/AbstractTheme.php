<?php

namespace Zoop\Theme\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Common\File\DataModel\ImageInterface;
use Zoop\Shard\Stamp\DataModel\CreatedOnTrait;
use Zoop\Shard\Stamp\DataModel\CreatedByTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedOnTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedByTrait;
use Zoop\Shard\SoftDelete\DataModel\SoftDeleteableTrait;
use Zoop\Store\DataModel\StoresTrait;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document(collection="Themes")
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 * @ODM\DiscriminatorField("type")
 * @ODM\DiscriminatorMap({
 *     "PrivateTheme"    = "Zoop\Theme\DataModel\PrivateTheme",
 *     "ZoopTheme"       = "Zoop\Theme\DataModel\ZoopTheme",
 *     "SharedTheme"     = "Zoop\Theme\DataModel\SharedTheme"
 * })
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
abstract class AbstractTheme implements ThemeInterface
{
    use CreatedOnTrait;
    use CreatedByTrait;
    use SoftDeleteableTrait;
    use StoresTrait;
    use UpdatedOnTrait;
    use UpdatedByTrait;

    /**
     * @ODM\Id
     */
    protected $id;

    /**
     * @ODM\String
     */
    protected $name;

    /**
     * @ODM\Boolean
     * @Shard\Unserializer\Ignore
     */
    protected $writeable;

    /**
     * @ODM\Boolean
     * @Shard\Unserializer\Ignore
     */
    protected $deleteable;

    /**
     * @ODM\ReferenceMany(
     *      targetDocument              =   "Zoop\Theme\DataModel\AbstractAsset",
     *      discriminatorMap={
     *          "Css"                   =   "Zoop\Theme\DataModel\Css",
     *          "Folder"                =   "Zoop\Theme\DataModel\Folder",
     *          "CompressCss"           =   "Zoop\Theme\DataModel\GzippedCss",
     *          "CompressJavascript"    =   "Zoop\Theme\DataModel\GzippedJavascript",
     *          "Image"                 =   "Zoop\Theme\DataModel\Image",
     *          "Javascript"            =   "Zoop\Theme\DataModel\Javascript",
     *          "Less"                  =   "Zoop\Theme\DataModel\Less",
     *          "Template"              =   "Zoop\Theme\DataModel\Template"
     *      },
     *      discriminatorField="type",
     *      mappedBy="parent",
     *      sort={
     *          "sortBy"    =   "asc",
     *          "name"      =   "asc"
     *      }
     * )
     * @Shard\Serializer\Eager
     */
    protected $assets;

    /**
     * @ODM\EmbedOne(targetDocument="Zoop\Common\DataModel\Image")
     */
    protected $screenshot;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return boolean
     */
    public function isWriteable()
    {
        return $this->writeable;
    }

    /**
     * @param boolean $writeable
     */
    public function setWriteable($writeable)
    {
        $this->writeable = (bool) $writeable;
    }

    /**
     * @return boolean
     */
    public function isDeleteable()
    {
        return $this->deleteable;
    }

    /**
     * @param boolean $deleteable
     */
    public function setDeleteable($deleteable)
    {
        $this->deleteable = (bool) $deleteable;
    }

    /**
     * @return ArrayCollection
     */
    public function getAssets()
    {
        if (!isset($this->assets)) {
            $this->assets = new ArrayCollection;
        }
        return $this->assets;
    }

    /**
     * @param ArrayCollection|array $assets
     */
    public function setAssets($assets)
    {
        if (is_array($assets)) {
            $assets = new ArrayCollection($assets);
        }
        $this->assets = $assets;
    }

    /**
     * @param AssetInterface $asset
     */
    public function addAsset(AssetInterface $asset)
    {
        if (!$this->getAssets()->contains($asset)) {
            $this->getAssets()->add($asset);
        }
    }

    /**
     * @return ImageInterface
     */
    public function getScreenshot()
    {
        return $this->screenshot;
    }

    /**
     * @param ImageInterface $screenshot
     */
    public function setScreenshot(ImageInterface $screenshot)
    {
        $this->screenshot = $screenshot;
    }
}
