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
 * Class DefaultControllerSession
 * @package App\Controller
 */
class DefaultControllerSession extends AbstractController
{

    /**
     * @Route("/", name="default")
     * @param GiftsService $gifts
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function index(GiftsService $gifts, Request $request, SessionInterface $session)
    {
        # Get users from repository
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        /* PHPSESSID will be empty if not session started */
        /* exit($request->cookies->get('PHPSESSID')); ex: pslpvqhqd0cfnajmlamcn3b1bf */

        # Set session
        $session->set('name', 'session value');

        # clear/remove session given name
        // $session->remove('name');

        # clear all session
        $session->clear();

        # get session given name
        if($session->has('name'))
        {
            exit($session->get('name'));
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gift' => $gifts->gifts
        ]);
    }

}
