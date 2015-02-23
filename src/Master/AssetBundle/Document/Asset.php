<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 23/02/2015
 * Time: 15:33
 */

namespace Master\AssetBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 * @MongoDB\Document
 */
class Asset{

    /**
     * @MongoDB\String
     */
    protected $pathasset;
    /**
     * @MongoDB\String
     */
    protected $extensionasset;
    /**
     * @MongoDB\String
     */
    protected $uriasset;
    /**
     * @MongoDB\String
     */
} 