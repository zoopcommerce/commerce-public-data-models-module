<?php

namespace Zoop\User\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Shard\Crypt\SaltGenerator;
use Zoop\Shard\Stamp\DataModel\CreatedOnTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedOnTrait;
use Zoop\Shard\Stamp\DataModel\CreatedByTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedByTrait;
use Zoop\Shard\SoftDelete\DataModel\SoftDeleteableTrait;
use Zoop\Shard\User\DataModel\PasswordTrait;
use Zoop\Shard\User\DataModel\UserTrait;
use Zoop\Shard\User\DataModel\RoleAwareUserTrait;
use Zoop\User\DataModel\ApiCredentialInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @author Josh Stuart <josh.stuart@zoopcommerce.com>
 *
 * @ODM\Document(
 *     collection="Users",
 *     indexes = {
 *         @ODM\Index(
 *              keys={
 *                  "email"="asc",
 *                  "username"="asc"
 *              }
 *         )
 *     }
 * )
 * @ODM\HasLifecycleCallbacks
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 * @ODM\DiscriminatorField(fieldName="type")
 * @ODM\DiscriminatorMap({
 *     "customer::admin" = "Zoop\User\DataModel\Customer\Admin",
 *     "comsumer" = "Zoop\User\DataModel\Consumer",
 *     "guest" = "Zoop\User\DataModel\Guest",
 *     "partner::admin" = "Zoop\User\DataModel\Partner\Admin",
 *     "store::admin" = "Zoop\User\DataModel\Store\Admin",
 *     "zoop::admin" = "Zoop\User\DataModel\Zoop\Admin"
 * })
 * @Shard\AccessControl({
 *      @Shard\Permission\Basic(roles="zoop::admin", allow="*"),
 *      @Shard\Permission\Basic(
 *          roles={
 *              "sys::authenticate",
 *              "sys::auth-user",
 *              "sys::user",
 *              "owner",
 *              "partner::admin",
 *              "customer::admin",
 *              "store::admin"
 *          },
 *          allow="read"
 *      ),
 *      @Shard\Permission\Basic(roles="sys::recoverpassword", allow="update::password"),
 *      @Shard\Permission\Basic(roles="owner", allow="update::*", deny="update::roles")
 * })
 */
class AbstractUser
{
    use CreatedOnTrait;
    use UpdatedOnTrait;
    use CreatedByTrait;
    use UpdatedByTrait;
    use SoftDeleteableTrait;
    use UserTrait;
    use PasswordTrait;
    use RoleAwareUserTrait;

    /**
     * @ODM\String
     */
    protected $firstName;

    /**
     * @ODM\String
     */
    protected $lastName;

    /**
     * @ODM\String
     * @Shard\Serializer\Ignore("ignore_when_serializing")
     * @Shard\Validator\Chain({
     *     @Shard\Validator\Required,
     *     @Shard\Validator\Email
     * })
     */
    protected $email;

    /**
     * @ODM\EmbedMany(targetDocument="\Zoop\User\DataModel\ApiCredential")
     */
    protected $apiCredentials = [];

    public function __construct()
    {
        //set a default salt because a pre persist isn't working
        $this->setSalt(SaltGenerator::generateSalt());
    }

    /**
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = (string) $email;
    }

    /**
     * @return ArrayCollection
     */
    public function getApiCredentials()
    {
        if (!$this->apiCredentials instanceof ArrayCollection) {
            $this->apiCredentials = new ArrayCollection;
        }
        return $this->apiCredentials;
    }

    /**
     * @param ArrayCollection $apiCredentials
     */
    public function setApiCredentials($apiCredentials)
    {
        if (is_array($apiCredentials)) {
            $this->apiCredentials = new ArrayCollection($apiCredentials);
        } else {
            $this->apiCredentials = $apiCredentials;
        }
    }

    /**
     * @param ApiCredential $apiCredential
     */
    public function addApiCredential(ApiCredentialInterface $apiCredential)
    {
        if (!$this->getApiCredentials()->contains($apiCredential)) {
            $this->getApiCredentials()->add($apiCredential);
        }
    }
}
