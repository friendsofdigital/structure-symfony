<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Master\UserBundle\Form\Handler;

use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\MailerInterface;
use FOS\UserBundle\Util\TokenGeneratorInterface;
use Master\AssetBundle\Service\ImageFactory;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Master\AssetBundle\Document\Asset;
use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;

class RegistrationFormHandler extends BaseHandler
{

    protected $imagefactory;

    public function __construct(FormInterface $form, Request $request, UserManagerInterface $userManager, MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator,ImageFactory $imageFactory)
    {
       parent::__construct($form,$request,$userManager,$mailer,$tokenGenerator);
        $this->imagefactory=$imageFactory;
    }


    public function process($confirmation = false)
    {

        $user = $this->userManager->createUser();
        $this->form->setData($user);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bind($this->request);
            $user->setToken(md5(uniqid($user->getUsername(), true)));
            $user->setFullname($user->getFirstname()." ".$user->getLastname());
            $asset=new Asset();
            $asset->setPathasset("/Profil/".$user->getToken());
            $asset->setExtensionasset(strtolower(explode(".",$user->getAsset()->getClientOriginalName())[1]));
            //URI IMAGE


            $uri=$this->imagefactory->save($user->getAsset(),$asset->getPathasset());
            $asset->setUriasset($uri);
            $user->setAsset($asset);
            if ($this->form->isValid()) {
                $this->onSuccess($user, $confirmation);
                return true;
            }
        }

        return false;
    }
    protected function onSuccess(UserInterface $user, $confirmation)
    {
        if ($confirmation) {
            $user->setEnabled(false);
            if (null === $user->getConfirmationToken()) {
                $user->setConfirmationToken($this->tokenGenerator->generateToken());
            }

            $this->mailer->sendConfirmationEmailMessage($user);
        } else {
            $user->setEnabled(true);
        }

        $this->userManager->updateUser($user);
    }



}
