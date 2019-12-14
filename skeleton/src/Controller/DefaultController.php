<?php

namespace App\Controller;

use App\Entity\User;
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
     * @return Response
     */
    public function index()
    {
       $users = $this->getDoctrine()
                     ->getRepository(User::class)
                     ->findAll();


       return $this->render('default/index.html.twig', [
           'controller_name' => 'DefaultController',
           'users' => $users
       ]);
    }


    public function indexRepository()
    {
        /* $users = ['Adam', 'Robert', 'Joe', 'Susan']; */

        $entityManager = $this->getDoctrine()->getManager();

        # User 1
        $user = new User();
        $user->setName('Adam');

        # User 2
        $user2 = new User();
        $user2->setName('Robert');

        # User 3
        $user3 = new User();
        $user3->setName('Joe');

        # User 3
        $user4 = new User();
        $user4->setName('Susan');

        # Prepare data to the saving
        $entityManager->persist($user);
        $entityManager->persist($user2);
        $entityManager->persist($user3);
        $entityManager->persist($user4);

        # Save data to the database
        $entityManager->flush();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users ?? []
        ]);
    }
}
