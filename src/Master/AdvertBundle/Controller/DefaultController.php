<?php

namespace Master\AdvertBundle\Controller;

use Elastica\Filter\GeoDistance;
use Elastica\Query\Filtered;
use Elastica\Query\MatchAll;
use Master\AdvertBundle\Document\Advert;
use Master\AdvertBundle\Document\Localization;
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
        $adverts=$this->advertShow($request,$p);
        return $this->render('AdvertBundle:Default:index.html.twig',array('advert'=>$adverts));
    }
    public function addAction(Request $request)
    {
        if($request->getMethod()=="POST") {
            $manager=$this->get('doctrine_mongodb');
            $localisation=new Localization();
            $localisation->setLatitude($request->request->get('lat'));
            $localisation->setLongitude($request->request->get('long'));
            $advert = new Advert();
            $advert->setTitle($request->request->get('title'));
            $advert->setDescription($request->request->get('description'));
            $advert->setFax($request->request->get('fax'));
            $advert->setTelephone($request->request->get('tel'));
            $advert->setTokenuser($this->getUser()->getToken());
            $advert->setLocalization($localisation);
            $manager->getManager()->persist($advert);
            $manager->getManager()->flush();
            $adverts=$this->advertShow($request,1);
            return $this->render('AdvertBundle:Default:index.html.twig',array("advert"=>$adverts));

        }else{
            return $this->render('AdvertBundle:Advert:add.html.twig');
        }


    }
    public function testAction(){
        $filter = new GeoDistance('location', array('lat' => -2.1741771697998047,
            'lon' => 43.28249657890983), '10000km');
        $query = new Filtered(new MatchAll(), $filter);
        $manager=$this->get('fos_elastica.finder.structure.advert');
        $test=$manager->find($query);
        var_dump($test);exit;

        return new Response("TEST");
    }
    public function advertShow($request,$p)
    {
        $manager=$this->get('fos_elastica.finder.structure.advert');
        $pagination=$manager->find("",100);
//        var_dump($pagination);exit;
        $paginator  = $this->get('knp_paginator');
        $adverts = $paginator->paginate(
            $pagination,
            $request->query->get('page', $p)/*page number*/,
            6/*limit per page*/
        );
        return $adverts;
    }
}
