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

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}