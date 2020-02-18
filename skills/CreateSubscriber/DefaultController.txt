<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use App\Services\GiftsService;
use App\Services\MyService;
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
     * DefaultController constructor.
     * @param EventDispatcherInterface $dispatcher
    */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @Route("/home", name="default", name="home")
     * @param Request $request
     * @return Response
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Psr\Cache\CacheException
     */
    public function index(Request $request)
    {
        /* $entityManager = $this->getDoctrine()->getManager(); */
        /* dump($request, $this); */

        $video = new \stdClass();

        $video->title = 'Fumy movie';
        $video->category = 'funny';

        $event = new VideoCreatedEvent($video);

        /* dd($event); */

        $this->dispatcher->dispatch($event, 'video.created.event');

        return $this->render('default/index.html.twig', [
           'controller_name' => 'DefaultController'
        ]);
    }


}
