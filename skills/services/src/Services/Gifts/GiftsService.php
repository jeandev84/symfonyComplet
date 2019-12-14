<?php
namespace App\Services\Gifts;


/**
 * Class GiftsService
 * @package App\Services\Gifts
*/
class GiftsService
{

   /** @var array  */
   public $gifts = ['flowers', 'car', 'piano', 'money'];


   /**
     * GiftsService constructor.
   */
   public function __construct()
   {
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