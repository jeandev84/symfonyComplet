<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
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
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo('recipient@exmaple.com')
            ->setBody(
                $this->renderView(
                    'emails/registration.html.twig',
                    ['name' => 'Robert']
                ),
                'text/html'
            );

        $mailer->send($message);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }


}
