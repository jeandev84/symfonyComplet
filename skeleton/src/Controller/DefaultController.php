<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/default/{name}", name="default")
     * @param $name
     * @return Response
     */
    public function index($name)
    {
        # Redirect to the name of route
        return $this->redirectToRoute('default2');

    }


    /**
     * @Route("/default/", name="default2")
     * @return Response
     */
    public function index2()
    {
        return new Response('I am form default2 route!');
    }

}
