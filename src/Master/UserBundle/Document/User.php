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
    protected $name;

    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
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