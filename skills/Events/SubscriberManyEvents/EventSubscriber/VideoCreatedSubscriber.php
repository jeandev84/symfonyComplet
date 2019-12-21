<?php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
#use Symfony\Component\HttpKernel\Event\FilterResponseEvent; deprecated
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpFoundation\Response;




/**
 * Class VideoCreatedSubscriber
 * @package App\EventSubscriber
 */
class VideoCreatedSubscriber implements EventSubscriberInterface
{

    /**
     * @param $event
   */
    public function onVideoCreatedEvent($event)
    {
        dump($event->video->title);
    }

    /**
     * @param ResponseEvent $event
    */
    public function onKernelResponse(ResponseEvent $event)
    {
        $response = new Response('dupa');
        $event->setResponse($response);
    }

    /* public function onKernelResponse(FilterResponseEvent $event) {} */

    public static function getSubscribedEvents()
    {
        return [
            'video.created.event' => 'onVideoCreatedEvent',
            KernelEvents::RESPONSE => 'onKernelResponse'
        ];
    }
}
