<?php
namespace App\Services;


/**
 * Class MyService
 * @package App\Services
 */
class MyService
{
    /**
     * MyService constructor.
     * @param $param
     * @param $param2
     * @param $adminEmail
     * @param $globalParam
     */
    public function __construct($param, $param2, $adminEmail, $globalParam)
    {
       /* dump('I am a live!'); */

        dump($param);
        dump($param2);
        dump($adminEmail);
        dump($globalParam);
    }
}