<?php
namespace App\Events;


use Symfony\Contracts\EventDispatcher\Event;


/**
 * Class VideoCreatedEvent
 * @package App\Events
*/
class VideoCreatedEvent extends Event
{
    public $video;

    /**
     * VideoCreatedEvent constructor.
     * @param $video
    */
    public function __construct($video)
    {
        $this->video = $video;
    }
}