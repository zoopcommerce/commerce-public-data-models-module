<?php

namespace Zoop\Common\DataModel;

use Zoop\Common\DataModel\SocialInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Social implements SocialInterface
{
    /**
     * @ODM\String
     */
    protected $facebook;

    /**
     * @ODM\String
     */
    protected $twitter;

    /**
     * @ODM\String
     */
    protected $youtube;

    /**
     * @ODM\String
     */
    protected $instagram;

    /**
     * @ODM\String
     */
    protected $googlePlus;

    /**
     * @ODM\String
     */
    protected $pinterest;

    /**
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     *
     * @param string $facebook
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     *
     * @param string $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return string
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     *
     * @param string $youtube
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;
    }

    /**
     * @return string
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     *
     * @param string $instagram
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;
    }

    /**
     * @return string
     */
    public function getGooglePlus()
    {
        return $this->googlePlus;
    }

    /**
     *
     * @param string $googlePlus
     */
    public function setGooglePlus($googlePlus)
    {
        $this->googlePlus = $googlePlus;
    }

    /**
     * @return string
     */
    public function getPinterest()
    {
        return $this->pinterest;
    }

    /**
     *
     * @param string $pinterest
     */
    public function setPinterest($pinterest)
    {
        $this->pinterest = $pinterest;
    }
}
