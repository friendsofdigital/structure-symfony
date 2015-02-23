<?php

namespace Master\AssetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AssetController extends Controller
{
    public function indexAction()
    {
        return $this->render("@Asset/Default/index.html.twig");
    }
}
