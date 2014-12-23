<?php

namespace Zoop\User\DataModel\Customer;

use Zoop\Common\User\PasswordInterface;
use Zoop\Common\User\RoleAwareUserInterface;
use Zoop\Common\User\UserInterface;
use Zoop\User\DataModel\AbstractUserFilter;
use Zoop\User\DataModel\CustomerAdminInterface;
use Zoop\User\Roles;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="zoop::admin", allow="*"),
 *     @Shard\Permission\Basic(roles={"sys::authenticate", "sys::auth-user", "owner"}, allow="read"),
 *     @Shard\Permission\Basic(roles="sys::recoverpassword", allow="update::password"),
 *     @Shard\Permission\Basic(roles="partner::admin", allow="*", deny="update::roles"),
 *     @Shard\Permission\Basic(roles="company::admin", allow={"create", "update::*"}, deny="update::roles"),
 *     @Shard\Permission\Basic(roles="owner", allow="update::*", deny="update::roles")
 * })
 */
class Admin extends AbstractUserFilter implements
    CustomerAdminInterface,
    PasswordInterface,
    RoleAwareUserInterface,
    UserInterface
{
    /**
     * @ODM\Collection
     */
    protected $roles = [
        Roles::CUSTOMER_ADMIN
    ];
}
