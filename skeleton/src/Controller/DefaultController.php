<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{

    /**
     * @Route("/home", name="default", name="home")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        # Create
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setName('Robert');
        $entityManager->persist($user);
        $entityManager->flush();

        dump('A new user was saved in the id of '. $user->getId());

        /* $user = $entityManager->getRepository(User::class)->find(1); */


       return $this->render('default/index.html.twig', [
           'controller_name' => 'DefaultController'
       ]);
    }



}
