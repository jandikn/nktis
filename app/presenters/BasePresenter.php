<?php

namespace App\Presenters;

use Nette,
    App\Model,
    Nette\Application\UI\Form;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	public function beforeRender()
	{
	  if ($this->isAjax()) {
	      $this->invalidateControl('flashMessages');
	  }

	  $this->template->menuItems = array(
	      'Projekty' => 'Project:',
	      'Archív' => 'Project:archive',
	      'Překladatelé' => 'Translator:',
	      'Zákazníci' => 'Customer:',
	      'Jazyky' => 'Language:',
	      'Obory' => 'Field:',
	      'NK v číslech' => 'Numbers:',
	      'Úkoly' => 'Task:',
	      'Můj profil' => 'MyProfile:'
	  );

	  
	}
        
        // v pripade ajaxu
        public function afterRender()
        {
            if ($this->isAjax() && $this->hasFlashSession())
                $this->invalidateControl('flashes');
        }

	// registrace tridy Helpers (slozka Vendor/Others)
	protected function createTemplate($class = NULL)
	{
	    $template = parent::createTemplate($class);
	    $template->registerHelperLoader('Helpers::loader');
	    return $template;
	}

	public function handleSignOut()
	{
	  $this->getUser()->logout();
	  $this->redirect('Sign:in');
	}

}
