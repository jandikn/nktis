<?php

namespace App\Presenters;

use Nette,
	Nette\Application\UI\Form,
	App\Model,
        App\Classes;


/**
 * Translator presenter.
 */
class TranslatorPresenter extends BasePresenter
{

   /** @var App\ProjectModel */
  private $projectModel;
  
  /** @var App\TranslatorModel */
  private $translatorModel;

  /** @var App\languageModel */
  private $languageModel;

  /** @var App\FieldModel */
  private $fieldModel;  

  /** @var App\PostModel */
  private $postModel;

  /** @var App\PostModel */
  private $helper;


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
      $this->postModel = $this->context->postModel;
      $this->helper = $this->context->helper;
  }


    public function renderDefault()
    {
        $this->template->translators = $this->translatorModel->getTranslators();
    }
    
    public function renderNew()
    {
        $this->template->posts = $this->postModel->getPosts();
        $this->template->languages = $this->languageModel->getLanguages();
        $this->template->fields = $this->fieldModel->getFields();
        $this->template->cattools = $this->translatorModel->getCatTools();
    }

    protected function createComponentNewTranslatorForm()
    {
      // overeni prihlaseni uzivatele
      if (!$this->getUser()->isLoggedIn()) {
          $this->redirect('Sign:in');
      }

      $posts = $this->postModel->getPosts();
      $post = array();
      foreach ($posts as $key => $value) {
        array_push($post, $value->name);
      }
      //$post = array_reverse($post, true);

      $languages = $this->languageModel->getLanguagesForNewTranslator();
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
      foreach($cattools as $key => $value) {
        array_push($cattool, $value->name);
      }

      $form = new Form($this, 'newTranslatorForm');

      $form->addRadioList('post', 'Funkce', $post)
          ->setDefaultValue(2);
      
      $form->addCheckboxList('languages', 'Ovládané jazyky', $language)
          ->addRule(Form::MIN_LENGTH, 'Musí být vybrány minimálně 2 jazyky překladatele.', 2)
          ->setAttribute('onclick', 'enableDisableIdEl("")');
      
      $form->addCheckboxList('native_language', 'Rodný jazyk', $language)
          ->addRule(Form::MIN_LENGTH, 'Musí být vybrán rodný jazyk překladatele.', 1);
      
      foreach($languages as $language) {
          $form->addText('translation_price_'.$language->id, '', 5)
              ->addCondition(FORM::EQUAL, 0)
                ->addRule(Form::FILLED, 'Je nutné zadat cenu za překlad.');
      }
      
      foreach($languages as $language) {
          $form->addText('proofreading_price_'.$language->id, '', 5);
      }
      
      foreach($languages as $language) {
          $form->addText('interpretation_price_'.$language->id, '', 5);
      }

      $form->addCheckboxList('field', 'Ovládané obory', $field)
          ->addRule(Form::FILLED, 'Je nutné vybrat obor(y) překladatele.');

      $form->addCheckboxList('cattool', 'CAT nástroje', $cattool);
      
      $form->addCheckbox('otherCATcheck', 'Jiný CAT nástroj')
          ->setAttribute('onclick', 'enableDisableIdEl("frm-newTranslatorForm-otherCATname")');
      
      $form->addText('otherCATname', 'Jiný CAT nástroj')
          ->addCondition(FORM::EQUAL, 0)
          ->addRule(Form::FILLED, 'Je nutné zadat nový CAT nástroj.');
/*

      foreach ($languages as $language) {
        $form->addCheckbox('target_language_'.$language->id, $language->name)
            ->setAttribute('onclick', 'enableDisable("checkbox_{$language->shortcut}")');
      }
*/
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

      $form->addText('tel_preset', 'Předvolba', 4)
          ->addRule(Form::FILLED, 'Je nutné zadat telefonní předvolbu.')
          ->addRule(Form::MIN_LENGTH, 'Telefonní předvolba musí mít délku alespoň %d číslic', 5)
          ->setDefaultValue('00420');

      $form->addText('telephone', 'Telefon', 27)
          ->addRule(Form::FILLED, 'Je nutné zadat telefon překladatele.')
          ->addRule(Form::INTEGER, 'Telefon musí obsahovat pouze čísla.')
          ->addRule(Form::MIN_LENGTH, 'Telefon musí mít délku alespoň %d číslic', 9);

      $form->addText('address', 'Adresa', 40)
          ->addRule(Form::FILLED, 'Je nutné zadat adresu překladatele.');

      $form->addText('postcode', 'PSČ', 4)
          ->addRule(Form::MIN_LENGTH, 'PSČ musí mít alespoň %d číslic', 5)
          ->addRule(Form::INTEGER, 'PSČ musí být celé číslo.')
          ->addRule(Form::FILLED, 'Je nutné zadat PSČ překladatele.');

      $form->addText('city', 'Město', 27)
          ->addRule(Form::FILLED, 'Je nutné zadat město překladatele.');

      $form->addText('reg_no', 'IČ', 40)
          ->addRule(Form::LENGTH, 'IČ musí mít délku %d číslic', 8)
          ->addRule(Form::INTEGER, 'IČ musí být celé číslo.')
          ->addRule(Form::FILLED, 'Je nutné zadat IČ překladatele.');
      
      $form->addButton('ares', 'Načíst z ARESu')
        ->setAttribute('onclick', '$this->helper->test()');

      $form->addText('tax_id_no', 'DIČ', 40)
          ->addCondition(Form::FILLED)
            ->addRule(Form::PATTERN, 'DIČ není ve správném tvaru', '([a-zA-Z]{2}[0-9]{8}');

      $form->addUpload('profile_pic', 'Fotografie')
          ->setOption('description', 'JPEG/PNG/GIF')
          ->addCondition(Form::FILLED)
            ->addRule(Form::IMAGE, 'Fotografie musí být JPEG, PNG nebo GIF.')
            ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 500 kB.', 500 * 1024 /* v bytech */);

      $form->addUpload('cv', 'Životopis')
          ->setOption('description', 'PDF')
          ->addCondition(Form::FILLED)
            ->addRule(Form::MIME_TYPE, 'Životpis musí být dokument ve formátu PDF.', 'application/pdf,application/x-pdf')
            ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 500 kB.', 500 * 1024 /* v bytech */);

      $form->addTextArea('notes', 'Poznámky', 50, 6)
          ->addRule(Form::MAX_LENGTH, 'Poznámky jsou příliš dlouhé.', 10000);

      $form->addCheckbox('mail_me')
          ->addCondition($form::EQUAL, TRUE)
              ->toggle('address-city')
              ->toggle('address-street')
              ->toggle('address-zipcode');
              
      $form->addText('street')
          ->setOption('id', 'address-street');
      $form->addText('zipcode')
          ->setOption('id', 'address-zipcode');

      $form->addSubmit('submit', 'Uložit překladatele')
          ->setAttribute('class', 'mybutton b_ok');
      
      $form->onSuccess[] = $this->newTranslatorFormSubmitted;
      
      return $form;
  }

  // odeslani noveho oboru
  public function newTranslatorFormSubmitted(Form $form)
  {
      $values = $form->getValues();
      $translatorId = $this->getParameter('id');

      if ($translatorId) {
          $translator = $this->translatorModel->editTranslator($translatorId);
          $translator->update($values);
      } else {
          $translator = $this->translatorModel->newTranslator($values);
      }

      $this->flashMessage('Překladatel úspěšně uložen.', 'success');
      $this->redirect('default');
  }
  
  
  // nacteni z aresu
  public function handleAres($ic) {
      //$this->translatorModel->projectDone($projectId);
      $this->flashMessage($ic, 'success');
      //$this->newTranslatorForm->name->value = 'Honza';
      
      if (!$this->isAjax()) {
          $this->redirect('this');
      } else {
          $this->invalidateControl();
      }
  }

  // editace prekladatele
  public function actionEdit($id)
  {
      $translator = $this->translatorModel->editTranslator($id);
      if (!$translator) {
          $this->error('Překladatel nebyl nalezen.');
      }  
      $this['newTranslatorForm']->setDefaults($translator->toArray());
  }

  // smazani prekladatele
  public function actionDelete($id)
  {
      $this->translatorModel->deleteTranslator($id);

      $this->flashMessage('Překladatel smazán.', 'success');
      $this->redirect('default');
  }

}
