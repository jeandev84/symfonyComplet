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
    public function onKernelResponse1(ResponseEvent $event)
    {
        $response = new Response('dupa1');

        dump('1');
    }

    /**
     * @param ResponseEvent $event
     */
    public function onKernelResponse2(ResponseEvent $event)
    {
        $response = new Response('dupa2');

        dump('2');
    }

    public static function getSubscribedEvents()
    {
        return [
            'video.created.event' => 'onVideoCreatedEvent',
            KernelEvents::RESPONSE => [
                # 1 and 2 is a priority number
                # we write what priority calling has each event
                ['onKernelResponse1', 2],
                ['onKernelResponse2', 1],
            ]
        ];
    }
}
