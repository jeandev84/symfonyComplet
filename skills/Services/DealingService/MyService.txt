<?php
namespace App\Services;


use Doctrine\ORM\Event\PostFlushEventArgs;


/**
 * Class MyService
 * @package App\Services
 */
class MyService implements ServiceInterface
{

    /**
     * MyService constructor
     */
    public function __construct()
    {
        dump('Hello from MyService!');
    }

}