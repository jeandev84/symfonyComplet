<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class DefaultControllerAboutService
 * @package App\Controller
 */
class DefaultControllerAboutService extends AbstractController
{
    /**
     * @var GiftsService
     */
    private $gifts;

    /**
     * DefaultController constructor.
     * @param GiftsService $gifts [ This Service is in service container ]
     */
    public function __construct(GiftsService $gifts)
    {
        # Set gifts inside the constructor
        $gifts->gifts = ['a', 'b', 'c', 'd'];
    }

    /**
     * @Route("/", name="default")
     * @param GiftsService $gifts [ This Service already exist in container ]
     * @return Response
     */
    public function index(GiftsService $gifts)
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        /*
        Replace by GiftsService ( Afin de ne pas se repeter dans le code )
        $gifts = ['flowers', 'car', 'piano', 'money'];
        shuffle($gifts);
        */

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gift' => $gifts->gifts
            /* 'random_gift' => $gifts->getGifts() */
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
