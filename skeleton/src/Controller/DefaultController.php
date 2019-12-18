<?php

namespace App\Controller;

use App\Entity\Address;
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
use App\Entity\Author;
use App\Entity\File;
use App\Entity\Pdf;
use App\Entity\Video;



/**
 * Class DefaultCont
 * roller
 * @package App\Controller
 */
class DefaultController extends AbstractController
{

    /**
     * @Route("/home", name="default", name="home")
     * @param GiftsService $gifts
     * @param Request $request
     * @return Response
     */
    public function index(GiftsService $gifts,Request $request)
    {
       /*
       METHOD 1 : Get Differente File with instanceof
       $entityManager = $this->getDoctrine()->getManager();

       $author = $entityManager->getRepository(Author::class)
                              ->find(1);
       dump($author);

       // One Author have Many File (OneToMany)
       foreach ($author->getFiles() as $file)
       {
           Get all type files
           dump($file->getFilename());

           Get only pdf files
           if($file instanceof Pdf)
           {
               dump($file->getFilename());
           }


       }
       */

       /* METHOD 2: */
        $entityManager = $this->getDoctrine()->getManager();

        $author = $entityManager->getRepository(Author::class)
                                ->findByIdWithPdf(1);

        foreach ($author->getFiles() as $file)
        {
              // if($file instanceof Pdf)
              dump($file->getFilename());
        }

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
