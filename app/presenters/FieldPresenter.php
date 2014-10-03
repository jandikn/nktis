<?php

namespace App\Presenters;

use Nette,
	Nette\Application\UI\Form,
	App\Model;


/**
 * Field presenter.
 */
class FieldPresenter extends BasePresenter
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
        $this->template->fields = $this->fieldModel->getFields();
    }

    protected function createComponentNewFieldForm()
    {
      // overeni prihlaseni uzivatele
      if (!$this->getUser()->isLoggedIn()) {
          $this->redirect('Sign:in');
      }

      $form = new Form($this, 'newFieldForm');

      $form->addText('name', 'Název', 40, 100)
          ->addRule(Form::FILLED, 'Je nutné zadat název oboru.')
          ->setOption('description', 'Technický');

      $form->addText('url_name', 'URL', 40, 100)
          ->addRule(Form::FILLED, 'Je nutné zadat URL oboru.')
          ->setOption('description', 'technicke-preklady');

      $form->addText('priority', 'Priorita')
          ->setType('number')
          ->addRule(Form::FILLED, 'Je nutné zadat prioritu oboru.')
          ->addRule(Form::INTEGER, 'Priorita musí být celé číslo.')
          ->addRule(Form::RANGE, 'Priorita musí být v rozsahu od %d do %d', array(1, 100))
          ->setOption('description', '20');

      $form->addTextArea('specification', 'Odvětví')
          ->addRule(Form::MAX_LENGTH, 'Odvětví je příliš dlouhé.', 10000)
          ->setOption('description', 'Návody;Manuály;Příručky;...');

      $form->addSubmit('submit', 'Uložit obor');

      $form->onSuccess[] = $this->fieldFormSubmitted;

      return $form;
    }

    // odeslani noveho oboru
    public function fieldFormSubmitted(Form $form)
    {
        $values = $form->getValues();
        $fieldId = $this->getParameter('id');

        if ($fieldId) {
            $field = $this->fieldModel->editField($fieldId);
            $field->update($values);
        } else {
            $field = $this->fieldModel->newField($values);
        }

        $this->flashMessage('Obor úspěšně uložen.', 'success');
        $this->redirect('default');
    }

    // editace oboru
    public function actionEdit($id)
    {
        $field = $this->fieldModel->editField($id);
        if (!$field) {
            $this->error('Obor nebyl nalezen.');
        }  
        $this['newFieldForm']->setDefaults($field->toArray());
    }

    // smazani oboru
    public function actionDelete($id)
    {
        $this->fieldModel->deleteField($id);

        $this->flashMessage('Obor smazán.', 'success');
        $this->redirect('default');
    }

    public function handleDeleteField($id) {
        $this->fieldModel->fieldModel($id);
        $this->flashMessage('Obor smazán.', 'success');
        if (!$this->isAjax()) {
            $this->redirect('this');
        } else {
            $this->invalidateControl();
        }
    }

}
