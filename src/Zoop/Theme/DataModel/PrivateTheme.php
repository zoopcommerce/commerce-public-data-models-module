<?php

namespace Zoop\Theme\DataModel;

use Zoop\Theme\DataModel\PrivateThemeInterface;
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
class PrivateTheme extends AbstractTheme implements PrivateThemeInterface
{
    /**
     * @ODM\Boolean
     * @Shard\Unserializer\Ignore
     */
    protected $writeable = true;

    /**
     * @ODM\Boolean
     * @Shard\Unserializer\Ignore
     */
    protected $deleteable = true;

    /**
     * @ODM\Boolean
     * @ODM\Index
     */
    protected $isActive = false;

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = (bool) $isActive;
    }
}
