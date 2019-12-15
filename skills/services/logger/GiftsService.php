<?php
namespace App\Services;


use Psr\Log\LoggerInterface;


/**
 * Class GiftsService
 * @package App\Services
 */
class GiftsService
{

    /** @var array  */
    public $gifts = ['flowers', 'car', 'piano', 'money'];


    /**
     * GiftsService constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $logger->info('Gifts were randomized!');

        shuffle($this->gifts);
    }

    /**
     * @return array
     */
    public function getGifts()
    {
        return $this->gifts;
    }
}