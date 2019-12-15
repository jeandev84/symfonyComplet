<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\GiftsService;
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
     * @Route("/", name="default")
     * @param GiftsService $gifts
     * @return Response
     */
    public function index(GiftsService $gifts)
    {
       # Get users from repository
       $users = $this->getDoctrine()
                     ->getRepository(User::class)
                     ->findAll();

       # Flash Message /* Notice work only by request */
       $this->addFlash(
           'notice',
           'Your changes were saved!'
       );


        $this->addFlash(
            'warning',
            'Your changes were saved!'
        );


       # render the view
       return $this->render('default/index.html.twig', [
           'controller_name' => 'DefaultController',
           'users' => $users,
           'random_gift' => $gifts->gifts
       ]);
    }

    /**
     * @Route("/blog/{page?}", name="blog_list", requirements={"page"="\d+"})
     * This {page?} mean that parameter "page' is optional parameter
     *
     * Example path: /blog
     */
    public function index2()
    {
        return new Response('Optional parameters in url and requirements for parameters');
    }

    /**
     * @Route(
     *   "/articles/{_locale}/{year}/{slug}/{category}",
     *   defaults={"category": "computers"},
     *   requirements={
     *     "_locale": "en|fr",
     *     "category": "computers|rtv",
     *     "year": "\d+"
     *  }
     * )
     *
     * Example path :
     *  /articles/en/2019/dell/computers
     *  /articles/en/2019/dell/rtv
    */
    public function index3()
    {
        return new Response('An Advanced route example');
    }



    /**
     * @Route({
     *   "nl" : "/over-ons",
     *   "en" : "/about-us"
     *  }, name="about_us"
     * )
     *
     */
    public function index4()
    {
        return new Response('Translated routes');
    }
}
