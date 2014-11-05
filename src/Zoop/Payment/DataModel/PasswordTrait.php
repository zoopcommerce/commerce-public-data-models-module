<?php

namespace Zoop\Payment\DataModel;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @author  Dolly Aswin <dolly.aswin@gmail.com>
 */
trait PasswordTrait
{
    /**
     * @ODM\String
     */
    protected $password;

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
