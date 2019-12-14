<?php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController
{

    public function index()
    {
        return new Response('<p>Hello!</p>');
    }
}