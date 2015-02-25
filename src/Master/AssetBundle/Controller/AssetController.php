<?php

namespace Master\AssetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetController extends Controller
{
    public function indexAction()
    {
        $repository = $this->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('UserBundle:User');

        $user = $repository->findAll();

        return $this->render("@Asset/Default/index.html.twig", array('users' => $user));
    }


}
