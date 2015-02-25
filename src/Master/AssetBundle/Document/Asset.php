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
/** @EmbeddedDocument *
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
     * @return mixed
     */
    public function getExtensionasset()
    {
        return $this->extensionasset;
    }

    /**
     * @param mixed $extensionasset
     */
    public function setExtensionasset($extensionasset)
    {
        $this->extensionasset = $extensionasset;
    }

    /**
     * @return mixed
     */
    public function getPathasset()
    {
        return $this->pathasset;
    }

    /**
     * @param mixed $pathasset
     */
    public function setPathasset($pathasset)
    {
        $this->pathasset = $pathasset;
    }

    /**
     * @return mixed
     */
    public function getUriasset()
    {
        return $this->uriasset;
    }

    /**
     * @param mixed $uriasset
     */
    public function setUriasset($uriasset)
    {
        $this->uriasset = $uriasset;
    }



} 