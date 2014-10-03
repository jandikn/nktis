<?php

class Helpers extends Nette\Object
{

    private $context;
    
    private $basePath;

    public function __construct($context)
    {
        $this->context = $context;
        $this->basePath = Nette\Environment::getHttpRequest()->getUrl()->getBasePath();
    }
    
    public static function loader($helper)
    {
        if (method_exists(__CLASS__, $helper)) {
            return array(__CLASS__, $helper);
        }
    }

    public static function shortify($s, $len = 10)
    {
        return mb_substr($s, 0, $len);
    }

    // ocena s DPH
    public static function priceWithVAT($price)
    {
        return ceil($price * 1.21);
    }

    // odstranění mezer
    public static function removeWhiteSpaces($string)
    {
        return str_replace(" ","",$string);
    }

    // PCS
    public static function postcode($string)
    {
        return substr($string,0,3).' '.substr($string,3,4);
    }

    // email lint
    public static function email($string)
    {
        echo '<a href="mailto:'.$string.'">'.$string.'</a>';
        return;
    }

    // obrazek a popisek pro fakturaci
    public static function invoicing($invoicing)
    {
        $basePath = Nette\Environment::getHttpRequest()->getUrl()->getBasePath();

        switch ($invoicing) {

            case 'individual':

                echo '<img src="'.$basePath.'images/individual.png" style="margin-bottom: -2px;"> Fyzická osoba';
                return;
                break;

            case 'corporate':

                echo '<img src="'.$basePath.'images/corporate.png" style="margin-bottom: -2px;"> Právnická osoba';
                return;
                break;

            default:
                echo '<img src="'.$basePath.'images/abroad.png" style="margin-bottom: -2px;"> Zahraničí';
                return;
                break;
        }
    }

    // obrazek a popisek pro fakturaci
    public static function invoicingShort($invoicing)
    {
        $basePath = Nette\Environment::getHttpRequest()->getUrl()->getBasePath();

        switch ($invoicing) {

            case 'individual':

                echo '<img src="'.$basePath.'images/individual.png" style="margin-bottom: -2px;"> FO';
                break;

            case 'corporate':

                echo '<img src="'.$basePath.'images/corporate.png" style="margin-bottom: -2px;"> PO';
                break;

            default:
                echo '<img src="'.$basePath.'images/abroad.png" style="margin-bottom: -2px;"> Zahr';
                break;
        }
        
        return;
    }

    // profil prekladatele
    public static function translatorProfile($translator)
    {
        echo '<a href="#" data-reveal-id="translatorProfile_'.$translator->id.'" class="" title="Detail překladatele">'.$translator->name.' '.$translator->surname.'</a>
            <!-- hidden inline form -->
            <div id="translatorProfile_'.$translator->id.'" class="reveal-modal">
                <h2>Detail překladatele</h2>
                <table class="popup">
                <tr><td>Jméno a příjmení</td>   <td>'.$translator->surname.'  '.$translator->name.'</td></tr>
                <tr><td>Adresa</td>             <td>'.$translator->address.'<br>'.$translator->postcode.', '.$translator->city.'</td></tr>
                <tr><td>Email</td>              <td>'.$translator->email.'</td></tr>
                <tr><td>Telefon</td>            <td>'.$translator->tel_preset.' '.$translator->telephone.'</td></tr>
                <tr><td>IČ</td>                 <td>'.$translator->reg_no.'</td></tr>
                <tr><td>DIČ</td>                <td>'.$translator->tax_id_no.'</td></tr>
                </table>
                <a class="close-reveal-modal">&#215;</a>
            </div>';
        
        return;
    }
    
    
    // ikonka postu
    public static function renderPostIcon($icon)
    {
        $basePath = Nette\Environment::getHttpRequest()->getUrl()->getBasePath();
        
        echo '<img src="'.$basePath.'images/posts/'.$icon.'" style="margin-bottom: -2px;">';
        return;
    }
    
    
    // ikonka jazyka
    public static function renderLanguageIcon($icon)
    {
        $basePath = Nette\Environment::getHttpRequest()->getUrl()->getBasePath();
        
        echo '<img src="'.$basePath.'images/languages/'.$icon.'" style="margin-bottom: 3px;">';
        return;
    }
    
    
    // ikonka jazyka
    public static function renderTranslatorIcon($post_id)
    {
        $basePath = Nette\Environment::getHttpRequest()->getUrl()->getBasePath();
        
        switch ($post_id) {
            case 1: 
                echo '<img src="'.$basePath.'images/posts/administrator.png" style="margin-bottom: -2px;">';
                break;
            
            case 2: 
                echo '<img src="'.$basePath.'images/posts/manager.png" style="margin-bottom: -2px;">';
                break;
            
            case 3: 
                echo '<img src="'.$basePath.'images/posts/translator.png" style="margin-bottom: -2px;">';
                break;

            default:
                break;
        }
        return;
    }
    

}
