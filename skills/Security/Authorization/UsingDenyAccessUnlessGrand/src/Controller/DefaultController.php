<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\SecurityUser;
use App\Entity\User;
use App\Form\RegisterUserType;
use App\Services\GiftsService;
use App\Services\MyService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Entity\Author;
use App\Entity\File;
use App\Entity\Pdf;
use App\Entity\Video;
use App\Services\ServiceInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use App\Events\VideoCreatedEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Form\VideoFormType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



/**
 * Class DefaultController
 * @package App\Controller
 * NB : user password (standardyurev), admin (passw)
 */
class DefaultController extends AbstractController
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;


    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * DefaultController constructor.
     * @param EventDispatcherInterface $dispatcher
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EventDispatcherInterface $dispatcher, EntityManagerInterface $entityManager)
    {
        $this->dispatcher = $dispatcher;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/home", name="home")
     *
     * If not logged in, we'll be redirected to /login page
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        /*
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(SecurityUser::class)->findAll();
        dump($users);
        */

        # User can not got to 'home page' if is not logged in
        # $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');


        # User can not got to 'home page' if is not admin
        $this->denyAccessUnlessGranted('ROLE_ADMIN');


        # User can not got to 'home page' if is not remembered
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }


    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     * @link https://symfony.com/doc/current/security/form_login.html
     * @link https://symfony.com/doc/current/security/form_login_setup.html
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        # Get error in the login process
        $error = $authenticationUtils->getLastAuthenticationError();

        # Get last user name
        $lastUsername = $authenticationUtils->getLastUsername();

        # Render view
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

}
