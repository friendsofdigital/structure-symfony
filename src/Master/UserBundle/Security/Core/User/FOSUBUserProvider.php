<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 01/02/2015
 * Time: 22:50
 */
namespace Master\UserBundle\Security\Core\User;

use FOS\UserBundle\Model\UserManagerInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Master\AssetBundle\Document\Asset;
use Master\AssetBundle\Service\ImageFactory;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class FOSUBUserProvider extends BaseClass
{

    private $imagefactory;

    public function __construct(UserManagerInterface $userManager,ImageFactory $imagefactory,array $p)
    {
        parent::__construct($userManager,$p);
        $this->imagefactory=$imagefactory;
    }
    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {


        $property = $this->getProperty($response);
        $username = $response->getUsername();
//on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($service);
        $setter_id = $setter . 'Id';
        $setter_token = $setter . 'AccessToken';
//we "disconnect" previously connected users
        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            $previousUser->$setter_id(null);
            $previousUser->$setter_token(null);
            $this->userManager->updateUser($previousUser);
        }
//we connect current user
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());
        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {

        $username = $response->getUsername();
        $email = $response->getEmail();

        $user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
//when the user is registrating
        if (null === $user) {
            $service = $response->getResourceOwner()->getName();
            $setter = 'set' . ucfirst($service);
            $setter_id = $setter . 'Id';
            $setter_token = $setter . 'AccessToken';
// create new user here
            $user = $this->userManager->createUser();
            $user->$setter_id($username);
            $user->$setter_token($response->getAccessToken());
            //Facebook Image to Asset
            $asset = new Asset();
            $user->setToken(md5(uniqid($user->getUsername(), true)));
            $asset->setPathasset("/Profil/" . $user->getToken());
//            var_dump($this->kernel);exit;
            $uri = $this->imagefactory->saveLink($response->getProfilePicture(), $asset->getPathasset());
            $asset->setExtensionasset("jpg");
            $asset->setUriasset($uri);
            $user->setAsset($asset);
            $user->setFullname($response->getRealName());
//I have set all requested data with the user's username
//modify here with relevant data
            $user->setRoles(array("ROLE_ADMIN"));
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword(null);
            $user->setEnabled(true);
            $this->userManager->updateUser($user);
            return $user;
        }
//if user exists - go with the HWIOAuth way
        $user = parent::loadUserByOAuthUserResponse($response);
        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';
//update access token
        $user->$setter($response->getAccessToken());
        return $user;
    }


}