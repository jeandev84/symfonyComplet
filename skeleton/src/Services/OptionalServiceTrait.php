<?php
namespace App\Services;


/**
 * Trait OptionalServiceTrait
 * @package App\Services
 */
trait OptionalServiceTrait
{

    /** @var  */
    private $service;


    /**
     * @required
     * @param MySecondService $second_service
    */
    public function setSecondService(MySecondService $second_service)
    {
        $this->service = $second_service;
    }
}