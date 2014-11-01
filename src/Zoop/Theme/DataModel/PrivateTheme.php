<?php

namespace Zoop\Theme\DataModel;

use Zoop\Store\DataModel\StoresTraitInterface;
use Zoop\Store\DataModel\StoresTrait;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class PrivateTheme extends AbstractTheme implements
    StoresTraitInterface,
    ThemeInterface
{
    use StoresTrait;

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
