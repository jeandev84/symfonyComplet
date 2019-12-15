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
     * @Route("/page", name="default")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
       // $entityManager = $this->getDoctrine()->getManager();
       // $user = $entityManager->getRepository(User::class)->find(1);


       return $this->render('default/index.html.twig', [
           'controller_name' => 'DefaultController'
       ]);
    }

}
