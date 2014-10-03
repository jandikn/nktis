<?php

class MyHelpers extends Nette\Object
{
    
    private $context;
    
    private $basePath;

    public function __construct($context)
    {
        $this->context = $context;
        $this->basePath = Nette\Environment::getHttpRequest()->getUrl()->getBasePath();
    }

    public function loader($helper)
    {
        if (method_exists($this, $helper)) {
            return callback($this, $helper);
        }
    }

    // obrazek a popisek pro fakturaci
    public function invoicing($invoicing) {
        switch ($invoicing) {
            case 'individual':
                echo '<img src="'.$this->basePath.'images/individual.png" style="margin-bottom: -2px;"> Fyzická osoba';
                break;
            case 'corporate':
                echo '<img src="'.$this->basePath.'images/corporate.png" style="margin-bottom: -2px;"> Právnická osoba';
                break;
            default:
                echo '<img src="'.$this->basePath.'images/abroad.png" style="margin-bottom: -2px;"> Zahraničí';
                break;
        }
    }  
    
    
    // tlacitko podle stavu projektu
    public function projectStatus($status)
    {
        switch($status)
        {
            case 0: echo 'Dokončeno';   break;
            case 1: echo 'Zaplaceno';   break;
            case 2: echo 'Vyúčtováno';  break;
            default: break;
        }
    }
    
    // odkaz url
    public function link($url)
    {
        echo '<a href="http://'.$url.'" title="'.$url.'" target="_blank">'.$url.'</a>';
        return;
    }
    
    // ocena s DPH
    public function priceWithVAT($price)
    {
        return round($price * 1.21);
    } 

}
