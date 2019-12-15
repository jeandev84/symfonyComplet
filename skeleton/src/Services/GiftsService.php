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
     * @param LoggerInterface $logger [ Call services only in the constructor ]
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