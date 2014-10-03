<?php

namespace App\Presenters;

use Nette,
	Nette\Application\UI\Form,
	App\Model,
    App\Classes;


/**
 * Translator presenter.
 */
class TranslatorTestPresenter extends BasePresenter
{
    
   private $em;
    
   public function __construct(\Kdyby\Doctrine\EntityManager $em) {
       $this->em = $em;
   }
   
   public function renderDefault() {
       $translatorDao = $this->em->getDao('App\Entities\Translator');
       
       $translator = $translatorDao->find(1);
       /** @var \App\Entities\Translator $test */
       dump($translator->getUncompletedTasksCount());
       //dump($translator->getTasks());
       dump($translator);
   }

}
