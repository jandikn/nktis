<?php

namespace App\Presenters;

use Nette,
	Nette\Application\UI\Form,
	App\Model;


/**
 * Language presenter.
 */
class LanguagePresenter extends BasePresenter
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
        $this->template->languages = $this->languageModel->getLanguages();
    }

    protected function createComponentNewLanguageForm()
    {
          // overeni prihlaseni uzivatele
          if (!$this->getUser()->isLoggedIn()) {
              $this->redirect('Sign:in');
          }

          $form = new Form($this, 'newLanguageForm');

          $active = array(
              '1' => 'Ano',
              '0' => 'Ne',
          );

          $form->addText('name', 'Název', 40)
              ->addRule(Form::FILLED, 'Je nutné zadat název jazyka.')
              ->setOption('description', 'Angličtina');

          $form->addText('instrumental_case', '7. pád', 40)
              ->addRule(Form::FILLED, 'Je nutné zadat 7. pád jazyka.')
              ->setOption('description', 'anglickým');

          $form->addText('url_name', 'URL název', 40)
              ->addRule(Form::FILLED, 'Je nutné zadat URL jazyka.')
              ->setOption('description', 'anglictina');

          $form->addText('shortcut', 'Zkratka', 10)
              ->addRule(Form::FILLED, 'Je nutné zadat zkratku jazyka.')
              ->setOption('description', 'en');

          $form->addUpload('icon', 'Ikonka')
              ->setRequired('Je nutné vybrat ikonku jazyka.')
              ->addRule(Form::IMAGE, 'Ikonka musí být JPEG, PNG nebo GIF.')
              ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 500 kB.', 500 * 1024 /* v bytech */)
              ->setOption('description', 'en.png (JPEG/PNG/GIF)');

          $form->addUpload('flag', 'Vlajka - pozadí')
              ->setRequired('Je nutné vybrat obrázek vlajku - pozadí.')
              ->addRule(Form::IMAGE, 'Vlajka - pozadí musí být JPEG, PNG nebo GIF.')
              ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 500 kB.', 500 * 1024 /* v bytech */)
              ->setOption('description', 'en_background.png (JPEG/PNG/GIF)');

          $form->addUpload('picture1', 'Doprovodný obrázek 1')
              ->setRequired('Je nutné vybrat doprovodný obrázek 1.')
              ->addRule(Form::IMAGE, 'Doprovodný obrázek 1 musí být JPEG, PNG nebo GIF.')
              ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 500 kB.', 500 * 1024 /* v bytech */)
              ->setOption('description', 'en_1.png (JPEG/PNG/GIF)');

          $form->addUpload('picture2', 'Doprovodný obrázek 2')
              ->setRequired('Je nutné vybrat doprovodný obrázek 2.')
              ->addRule(Form::IMAGE, 'Doprovodný obrázek 2 musí být JPEG, PNG nebo GIF.')
              ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 500 kB.', 500 * 1024 /* v bytech */)
              ->setOption('description', 'en_2.png (JPEG/PNG/GIF)');

          $form->addRadioList('active', 'Jazyk aktivní', $active)
              ->setDefaultValue('1');

          $form->addCheckbox('translations', 'Překlady')
              ->setAttribute('onclick', 'enableDisableIdEl("frm-newLanguageForm-translation_price")');

          $form->addText('translation_price', 'Cena za překlad')->setDisabled()
              ->addCondition(FORM::EQUAL, 0)
              ->addRule(Form::FILLED, 'Je nutné zadat cenu za překlad.');

          $form->addCheckbox('proofreading', 'Korektury')
              ->setAttribute('onclick', 'enableDisableIdEl("frm-newLanguageForm-proofreading_price")');

          $form->addText('proofreading_price', 'Cena za korekturu')->setDisabled()
              ->addCondition(FORM::EQUAL, 0)
              ->addRule(Form::FILLED, 'Je nutné zadat cenu za korekturu.');

          $form->addCheckbox('interpretation', 'Tlumočení')
              ->setAttribute('onclick', 'enableDisableIdEl("frm-newLanguageForm-interpretation_price")');

          $form->addText('interpretation_price', 'Cena za tlumočení')->setDisabled()
              ->addCondition(FORM::EQUAL, 0)
              ->addRule(Form::FILLED, 'Je nutné zadat cenu za tlumočení.');

          $form->addText('language_sentence', 'S námi budete rozumět světu', 66)
              ->addRule(Form::FILLED, 'Je nutné zadat překlad věty "S námi budete rozumět světu" do daného jazyka.');

          $form->addTextArea('about_language', 'O jazyku', 60, 10)
              ->addRule(Form::FILLED, 'Je nutné napsat text "O jazyku."')
              ->addRule(Form::MAX_LENGTH, 'Text "O jazyku" je příliš dlouhý.', 10000);

          $form->addSubmit('submit', 'Uložit jazyk')
              ->setAttribute('class', 'mybutton b_ok');

          $form->onSuccess[] = $this->languageFormSubmitted;

          return $form;
      }

      // odeslani noveho oboru
      public function languageFormSubmitted(Form $form)
      {
          $values = $form->getValues();
          $languageId = $this->getParameter('id');

          if ($languageId) {
              $language = $this->languageModel->editLanguage($languageId);
              $language->update($values);
          } else {
              $language = $this->languageModel->newLanguage($values);
          }

          $this->flashMessage('Jazyk úspěšně uložen.', 'success');
          $this->redirect('default');
      }

      // editace oboru
      public function actionEdit($id)
      {
          $language = $this->languageModel->editLanguage($id);
          if (!$language) {
              $this->error('Jazyk nebyl nalezen.');
          }  
          $this['newLanguageForm']->setDefaults($language->toArray());
      }

      // smazani oboru
      public function actionDelete($id)
      {
          $this->languageModel->deleteLanguage($id);

          $this->flashMessage('Obor smazán.', 'success');
          $this->redirect('default');
      }

      // deaktivace jazyka
      public function handleDeactivateLanguage($id) {
          $this->languageModel->deactivateLanguage($id);
          $this->flashMessage('Jazyk deaktivován.', 'success');
          if (!$this->isAjax()) {
              $this->redirect('this');
          } else {
              $this->invalidateControl();
          }
      }

      public function handleActivateLanguage($id) {
          $this->languageModel->activateLanguage($id);
          $this->flashMessage('Jazyk aktivován.', 'success');
          if (!$this->isAjax()) {
              $this->redirect('this');
          } else {
              $this->invalidateControl();
          }
      }

}
