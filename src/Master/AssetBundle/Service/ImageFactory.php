<?php

/* * *****************************************************
 * Copyright (C) 2014-2015 Digitalement Correct
 *
 *
 * @author Bentoto Yassine <bentotoyassine@gmail.com>
 * ***************************************************** */

namespace Master\AssetBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;

/*
 * Asset service to Resize and crop Image
 */

class ImageFactory
{

    private $kernel, $name;
    private static $kernetstatic;

    public function __construct($kernel)
    {
        $this->kernel = $kernel;
        $this->name = md5(uniqid(rand(), true));
    }


    public function save(UploadedFile $file, $folder)
    {
        $name = md5(uniqid(rand(), true));
        $url = $this->kernel . '/../web/upload' . $folder . '/';

        if (!is_dir($url)) {
            mkdir($url, 0755, true);
        }
        $file->move($url, $name . '.jpg');
        return $name;
    }





    public  function saveLink($f, $folder  )
    {
        $name = md5(uniqid(rand(), true));
        $url = $this->kernel . '/../web/upload' . $folder . '/';
        if (!is_dir($url)) {
            mkdir($url, 0755, true);
        }
        $image = file_get_contents($f);
        file_put_contents($url . $name . '.jpg', $image);
        return $name;
    }
}