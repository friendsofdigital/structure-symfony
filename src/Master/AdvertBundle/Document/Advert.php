<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 25/02/2015
 * Time: 13:33
 */

namespace Master\AdvertBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Advert
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;
    /**
     * @MongoDB\String
     */
    protected $token;
    /**
     * @MongoDB\String
     */
    protected $title;
    /**
     * @MongoDB\String
     */
    protected $description;
    /**
     * @MongoDB\String
     */
    protected $telephone;
    /**
     * @MongoDB\String
     */
    protected $fax;
    /**
     * @MongoDB\String
     */
    protected $website;
    /**
     * @MongoDB\String
     */
    protected $tokenuser;
    /**
     * @MongoDB\EmbedOne(targetDocument="Master\AssetBundle\Document\Asset") **
     */
    protected $asset;
    /**
     * @MongoDB\EmbedMany(targetDocument="Master\AdvertBundle\Document\Localization") **
     */
    protected $localization;

    /**
     * @return mixed
     */
    public function getTokenuser()
    {
        return $this->tokenuser;
    }

    /**
     * @param mixed $tokenuser
     */
    public function setTokenuser($tokenuser)
    {
        $this->tokenuser = $tokenuser;
    }


    public function __construct(){
        $this->token= md5(uniqid(mt_rand(), true));
    }
    /**
     * @return mixed
     */
    public function getAsset()
    {
        return $this->asset;
    }

    /**
     * @param mixed $asset
     */
    public function setAsset($asset)
    {
        $this->asset = $asset;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param mixed $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLocalization()
    {
        return $this->localization;
    }

    /**
     * @param mixed $localization
     */
    public function setLocalization($localization)
    {
        $this->localization = $localization;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }


}