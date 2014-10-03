<?php
namespace App;
use Nette;


/**
 * Translator Model.
 */
class Helper extends Nette\Object
{

    // ocena s DPH
    public function priceWithVAT($price)
    {
        return round($price * 1.21);
    }
    
    public function test()
    {
        echo 'ok';
        die();
        return;
    }
    
}
