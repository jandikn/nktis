<?php

namespace App\Presenters;

use Nette,
	Nette\Application\UI\Form,
	App\Model;


/**
 * MyProfile presenter.
 */
class MyProfilePresenter extends BasePresenter
{

   /** @var App\ProjectModel */
  private $projectModel;
  
  /** @var App\TranslatorModel */
  private $translatorModel;

  /** @var App\languageModel */
  private $languageModel;

  /** @var App\FieldModel */
  private $fieldModel;


  protected function startup()
  {
      parent::startup();
  
      if (!$this->getUser()->isLoggedIn()) {
          $this->redirect('Sign:in');
      }
  
      $this->projectModel = $this->context->projectModel;
      $this->translatorModel = $this->context->translatorModel;
      $this->languageModel = $this->context->languageModel;
      $this->fieldModel = $this->context->fieldModel;
  }


	public function renderDefault()
	{
		  $this->template->myProfile = $this->translatorModel->getMyProfile($this->getUser()->getIdentity()->id);
	}

	protected function createComponentEditProfileForm()
  {
      // overeni prihlaseni uzivatele
      if (!$this->getUser()->isLoggedIn()) {
          $this->redirect('Sign:in');
      }

      $form = new Form($this, 'editProfileForm');

      $languages = $this->languageModel->getLanguagesForNewProject();
      $language = array();
      foreach ($languages as $key => $value) {
        array_push($language, $value->name);
      }

      $fields = $this->fieldModel->getFieldsForNewProject();
      $field = array();
      foreach ($fields as $key => $value) {
        array_push($field, $value->name);
      }

      $cattools = $this->translatorModel->getCatTools();
      $cattool = array();
      foreach ($cattools as $key => $value) {
        array_push($cattool, $value->name);
      }

      $form->addCheckboxList('languages', 'Ovládané jazyky', $language)
          ->addRule(Form::MIN_LENGTH, 'Musí být vybrány minimálně 2 jazyky překladatele.', 2);

      $form->addCheckboxList('field', 'Ovládané obory', $field)
          ->addRule(Form::FILLED, 'Je nutné vybrat obor(y) překladatele.');

      $form->addCheckboxList('cattool', 'CAT nástroje', $cattool);
      
      $form->addGroup('Personal data');
      $form->addText('title', 'Titul', 10);

      $form->addText('name', 'Jméno', 40)
          ->addRule(Form::FILLED, 'Je nutné zadat jméno překladatele.');

      $form->addText('surname', 'Příjmení', 40)
          ->addRule(Form::FILLED, 'Je nutné zadat příjmení překladatele.');

      $form->addText('email', 'E-mail', 40)
          ->setType('email')
          ->addRule(Form::FILLED, 'Je nutné zadat email překladatele.')
          ->addRule(Form::EMAIL, 'E-mail musí být ve tvaru user@example.com.');

      $form->addText('tel_preset', 'Předvolba', 10)
          ->addRule(Form::FILLED, 'Je nutné zadat telefonní předvolbu.')
          ->addRule(Form::MIN_LENGTH, 'Telefonní předvolba musí mít délku alespoň %d číslic', 5)
          ->setDefaultValue('00420');

      $form->addText('telephone', 'Telefon', 23)
          ->addRule(Form::FILLED, 'Je nutné zadat telefon překladatele.')
          ->addRule(Form::INTEGER, 'Telefon musí obsahovat pouze čísla.')
          ->addRule(Form::MIN_LENGTH, 'Telefon musí mít délku alespoň %d číslic', 9);

      $form->addText('address', 'Adresa', 40)
          ->addRule(Form::FILLED, 'Je nutné zadat adresu překladatele.');

      $form->addText('postcode', 'PSČ', 40)
          ->addRule(Form::MIN_LENGTH, 'PSČ musí mít alespoň %d číslic', 5)
          ->addRule(Form::INTEGER, 'PSČ musí být celé číslo.')
          ->addRule(Form::FILLED, 'Je nutné zadat PSČ překladatele.');

      $form->addText('city', 'Město', 40)
          ->addRule(Form::FILLED, 'Je nutné zadat město překladatele.');

      $form->addText('reg_no', 'IČ', 40)
          ->addRule(Form::LENGTH, 'IČ musí mít délku %d číslic', 8)
          ->addRule(Form::INTEGER, 'IČ musí být celé číslo.')
          ->addRule(Form::FILLED, 'Je nutné zadat IČ překladatele.');

      $form->addText('tax_id_no', 'DIČ', 40);

      $form->addUpload('profile_pic', 'Fotografie')
        ->addRule(Form::IMAGE, 'Fotografie musí být JPEG, PNG nebo GIF.')
        ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 500 kB.', 500 * 1024 /* v bytech */)
        ->setOption('description', 'JPEG/PNG/GIF');

      $form->addUpload('cv', 'Životopis')
        ->addRule(Form::MIME_TYPE, 'Životpis musí být dokument ve formátu PDF.', 'application/pdf,application/x-pdf')
        ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 500 kB.', 500 * 1024 /* v bytech */)
        ->setOption('description', 'PDF');

      $form->addSubmit('cancel', 'Zrušit editaci')
        ->setAttribute('class', 'mybutton b_cancel')
        ->setValidationScope(FALSE)
        ->onClick[] = callback($this, 'editProfileFormCancelled');
      
      $form->addSubmit('submit', 'Uložit profil')
        ->setAttribute('class', 'mybutton b_ok');
      
      $form->onSuccess[] = $this->editProfileFormSubmitted;
      
      return $form;
  }

  // ulozeni profilu
  public function editProfileFormSubmitted(Form $form)
  {
      $values = $form->getValues();
      $translatorId = $this->getParameter('id');

      if ($translatorId) {
          $translator = $this->translatorModel->editMyProfile($translatorId);
          $translator->update($values);
      } else {
          $translator = $this->translatorModel->newTranslator($values);
      }

      $this->flashMessage('Profil úspěšně uložen.', 'success');
      $this->redirect('default');
  }
  
  // zruseni ulozeni
  public function editProfileFormCancelled()
  {
      $this->redirect('default');
  }

  // editace oboru
  public function actionEdit($id)
  {
      $translator = $this->translatorModel->editTranslator($id);
      if (!$translator) {
          $this->error('Profil nebyl nalezen.');
      }  
      $this['editProfileForm']->setDefaults($translator->toArray());
  }

}
