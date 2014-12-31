<?php

namespace Zoop\Customer\DataModel;

use Zoop\Customer\DataModel\CustomerInterface;
use Zoop\Entity\DataModel\AbstractEntityFilter;
use Zoop\Entity\DataModel\EntityInterface;
use Zoop\Partner\DataModel\PartnerInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @author Josh Stuart <josh.stuart@zoopcommerce.com>
 *
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="zoop::admin", allow="*"),
 *     @Shard\Permission\Basic(roles="partner::admin", allow="*"),
 *     @Shard\Permission\Basic(roles="company::admin", allow={"read", "update::*"}, deny={"delete", "update::softDeleted", "update::entities"})
 * })
 */
class Customer extends AbstractEntityFilter implements CustomerInterface
{
    /**
     * @ODM\ReferenceOne(targetDocument="Zoop\Partner\DataModel\Partner", simple=true)
     */
    protected $partner;
    
    /**
     * @return EntityInterface
     */
    public function getParent()
    {
        return $this->getPartner();
    }
    
    /**
     * @return EntityInterface
     */
    public function setParent(EntityInterface $parent)
    {
        $this->setPartner($parent);
    }

    /**
     * @return PartnerInterface
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * @return PartnerInterface
     */
    public function setPartner(PartnerInterface $partner)
    {
        $this->partner = $partner;
    }
}