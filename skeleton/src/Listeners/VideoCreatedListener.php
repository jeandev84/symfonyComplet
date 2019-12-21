<?php
namespace App\Listeners;


/**
 * Class VideoCreatedListener
 * @package App\Listeners
*/
class VideoCreatedListener
{
    /**
     * @param $event
    */
   public function onVideoCreatedEvent($event)
   {
        dump($event->video->title);
   }
}