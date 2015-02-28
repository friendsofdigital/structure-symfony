<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 25/02/2015
 * Time: 14:14
 */
namespace Master\AdvertBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 ** @MongoDB\EmbeddedDocument *
 */
class Localization
{
    /**
     * @MongoDB\int
     */
    protected $number;
    /**
     * @MongoDB\int
     */
    protected $codepostal;
    /**
     * @MongoDB\String
     */
    protected $city;
    /**
     * @MongoDB\float
     */
    protected $longitude;
    /**
     * @MongoDB\float
     */
    protected $latitude;

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * @param mixed $codepostal
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }


}