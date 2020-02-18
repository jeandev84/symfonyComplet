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




/**
 * Class DefaultController
 * @package App\Controller
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
     * @Route("/home", name="default", name="home")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(SecurityUser::class)->findAll();
        dump($users);

        # Create a new user (from Entity SecurityUser)
        $user = new SecurityUser();

        # Create First User:
        /*
        $user->setEmail('user@user.com');
        $password = $passwordEncoder->encodePassword($user, 'passw');
        $user->setPassword($password);
        $entityManager->persist($user);
        $entityManager->flush();
        dump($user->getId());
        */

        # By default all user have role ROLE_USER
        $user->setEmail('admin@admin.com');
        $password = $passwordEncoder->encodePassword($user, 'passw');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN']);

        $video = new Video();
        $video->setTitle('video title');
        $video->setFile('video path');
        $video->setCreatedAt(new \DateTime());
        $entityManager->persist($video);

        $user->addVideo($video);

        $entityManager->persist($user);
        $entityManager->flush();

        dump($user->getId());
        dump($video->getId());


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
