<?php

namespace Master\AdvertBundle\Controller;

use Master\AdvertBundle\Document\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $p=1;
        if($request->query->get('page')!=null)
            $p=intval($request->query->get('page'));
        $manager=$this->get('fos_elastica.index.structure.advert');
        $pagination=$manager->search()->getResults();
        $paginator  = $this->get('knp_paginator');
        $adverts = $paginator->paginate(
            $pagination,
            $request->query->get('page', $p)/*page number*/,
            2/*limit per page*/
        );
        return $this->render('AdvertBundle:Default:index.html.twig',array('advert'=>$adverts));
    }
    public function addAction(Request $request)
    {
        if($request->getMethod()=="POST") {
            $manager=$this->get('doctrine_mongodb');
            $advert = new Advert();
            $advert->setTitle($request->request->get('title'));
            $advert->setDescription($request->request->get('description'));
            $advert->setFax($request->request->get('fax'));
            $advert->setTelephone($request->request->get('tel'));
            $advert->setTokenuser($this->getUser()->getToken());

            $manager->getManager()->persist($advert);
            $manager->getManager()->flush();

        }else{
            return $this->render('AdvertBundle:Advert:add.html.twig');
        }
        $manager=$this->get('fos_elastica.index.structure.advert');
        $adverts=$manager->search()->getResults();
        return $this->render('AdvertBundle:Default:index.html.twig',array("advert"=>$adverts));
    }
}
