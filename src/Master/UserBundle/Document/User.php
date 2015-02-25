<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 01/02/2015
 * Time: 19:18
 */

namespace Master\UserBundle\Document;

use FOS\UserBundle\Document\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;
    /**
     * @MongoDB\String
     */
    protected $firstname;
    /**
     * @MongoDB\String
     */
    protected $token;
    /**
     * @MongoDB\String
     */
    protected $lastname;
    /**
     * @MongoDB\String
     */
    protected $facebook_id;
    /**
     * @MongoDB\String
*/
    protected $facebook_access_token;
    /**
     * @MongoDB\String
     */
    protected $profileimage;
    /**
     * @MongoDB\String
     */
    protected $fullname;
    /**
     * @MongoDB\EmbedOne(targetDocument="Master\AssetBundle\Document\Asset") **
     */
    protected $asset;

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
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param mixed $fullname
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }



    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }



    public function getProfileimage()
    {
        return $this->profileimage;
    }


    public function setProfileimage($profileimage)
    {
        $this->profileimage = $profileimage;
    }


    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }


    public function setFacebookAccessToken($facebook_access_token)
    {
        $this->facebook_access_token = $facebook_access_token;
    }


    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    public function setFacebookId($facebook_id)
    {
        $this->facebook_id = $facebook_id;
    }


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}