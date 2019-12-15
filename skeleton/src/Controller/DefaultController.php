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





/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="default")
     * @param GiftsService $gifts
     * @param Request $request
     * @return Response
     */
    public function index(GiftsService $gifts, Request $request)
    {
       $users = $this->getDoctrine()
                     ->getRepository(User::class)
                     ->findAll();

       return $this->render('default/index.html.twig', [
           'controller_name' => 'DefaultController',
           'users' => $users,
           'random_gift' => $gifts->gifts
       ]);
    }

}
