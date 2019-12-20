<?php
namespace App\Services;


/**
 * Class MySecondService
 * @package App\Services
 */
class MySecondService implements ServiceInterface
{

    /**
     * MySecondService constructor
    */
    public function __construct()
    {
       dump('Hello from MySecondService');
    }

}