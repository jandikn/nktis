<?php

namespace App\Presenters;

use Nette,
	Nette\Application\UI\Form,
        Nette\Image,
	App\Model;


/**
 * Project presenter.
 */
class ProjectPresenter extends BasePresenter
{

   /** @var App\ProjectModel */
  private $projectModel;
  
  /** @var App\TranslatorModel */
  private $translatorModel;
  
  /** @var App\CustomerModel */
  private $customerModel;

  /** @var App\languageModel */
  private $languageModel;

  /** @var App\FieldModel */
  private $fieldModel;
  
  private $archiveYear;
  
  private $basePath;

  protected function startup()
  {
      parent::startup();
  
      if (!$this->getUser()->isLoggedIn()) {
          $this->redirect('Sign:in');
      }
  
      $this->projectModel = $this->context->projectModel;
      $this->translatorModel = $this->context->translatorModel;
      $this->customerModel = $this->context->customerModel;
      $this->languageModel = $this->context->languageModel;
      $this->fieldModel = $this->context->fieldModel;
      
      $this->basePath = Nette\Environment::getHttpRequest()->getUrl()->getBasePath();
  }


  public function renderDefault()
  {
      $this->template->projects = $this->projectModel->getUnfinishedProjects();
  }
  
  public function renderTranslation() {
      $this->template->proj_type = array('translation' => 'Překlad', 'proofreading' => 'Korektura', 'interpretation' => 'Tlumočení', 'other' => 'Jiné');
      $this->template->languages = $this->languageModel->getLanguages();
  }


  public function renderInvoice()
  {
      $this->template->projects = $this->projectModel->getProjectsForInvocing();
  }


  public function renderArchive()
  {
      if($this->archiveYear == '') {
          $this->archiveYear = date ('Y');
      }
      
      $this->template->projects = $this->projectModel->getArchiveProjects($this->archiveYear);
      $this->template->year = $this->archiveYear;
  }
  
  
  public function handleShowCustomerDetail($id)
    {
        $this->redrawControl('customerDetail-'.$id);
    }


  public function createComponentNewProjectForm()
  {
      // overeni prihlaseni uzivatele
      if (!$this->getUser()->isLoggedIn()) {
          $this->redirect('Sign:in');
      }
      
      $proj_type = array('translation' => 'Překlad', 'proofreading' => 'Korektura', 'interpretation' => 'Tlumočení', 'other' => 'Jiné');
      $proj_leaders = $this->translatorModel->getManagers();
      $proj_leader = array();
      foreach ($proj_leaders as $key => $value) {
        array_push($proj_leader, $value->name.' '.$value->surname);
      }

      $customers = $this->customerModel->getCustomersForNewProject();
      $customer = array();
      foreach ($customers as $key => $value) {
        if($value->company != NULL) {
            array_push($customer, $value->company.' - '.$value->surname.' '.$value->name);
        }
        else {
            array_push($customer, $value->surname.' '.$value->name);
        }
      }

      $languages = $this->languageModel->getLanguagesForNewProject();
      $language = array();
      foreach ($languages as $key => $value) {
        array_push($language, $value->name);
      }

      $translators = $this->translatorModel->getTranslators();
      $translator = array();
      foreach ($translators as $key => $value) {
        array_push($translator, $value->surname);
      }

      $fields = $this->fieldModel->getFieldsForNewProject();
      $field = array();
      foreach ($fields as $key => $value) {
        array_push($field, $value->name);
      }

      $discount = array('quantity' => 'Množstevní', 'repetition' => 'Opakování');

      $extra_payment = array('expertness' => 'Odbornost', 'pdf' => 'Zpracování PDF', 'graphics' => 'Grafické zpracování', 'express' => 'Expresní doručení', 'holiday_work' => 'Práce přes svátek');
     
      $form = new Form($this, 'newProjectForm');

      $form->addRadioList('proj_type', 'Typ projektu', $proj_type)
          ->setDefaultValue('translation')
          ->getSeparatorPrototype()->setName(NULL);
      
      $form->addText('other_proj_type', 'Jiný typ projektu')->setDisabled()
          ->addCondition(FORM::EQUAL, 0)
          ->addRule(Form::FILLED, 'Je nutné zadat jiný typ projektu.');

      $form->addRadioList('proj_leader', 'Vedoucí projektu', $proj_leader);

      $form->addText('proj_name', 'Název', 50)
          ->addRule(Form::FILLED, 'Je nutné zadat název projektu.');

      $form->addSelect('customer', 'Zákazník', $customer)
          ->setPrompt('- Vyberte -')
          ->addRule(Form::FILLED, 'Je nutné vybrat zákazníka projektu.');

      $form->addRadioList('source_language', 'Zdrojový jazyk', $language)
          ->addRule(Form::FILLED, 'Je nutné zadat zdrojový jazyk projektu.')
          ->setAttribute('onclick', 'enableElements("target_language")');

      $form->addCheckboxList('target_language', 'Cílový jazyk', $language)->setDisabled()
          ->addRule(Form::MIN_LENGTH, 'Je nutné zadat minimálně %d cílový jazyk projektu.', 1)
          ->setAttribute('class', 'target_language');

      $form->addCheckboxList('translator', 'Překladatel', $translator)
          ->setAttribute('class', 'translator');

      $form->addText('pages', 'NS')
          ->setType('number')
          ->addRule(Form::FILLED, 'Je nutné zadat počet normostran projektu.');

      $form->addSelect('field', 'Obor', $field)
          ->setPrompt('- Vyberte -')
          ->addRule(Form::FILLED, 'Je nutné vybrat obor projektu.');

      $form->addText('price', 'Cena (Kč)')
          ->setType('number')
          ->addRule(Form::FILLED, 'Je nutné zadat cenu projektu.');

      $form->addCheckbox('sleva', 'Sleva')
          ->setAttribute('onclick', 'enableDisable("sleva1")');

      $form->addText('sleva1', 'Sleva1')->setDisabled()
          ->setAttribute('class', 'sleva1')
          ->getControlPrototype()
            ->onclick("this.value = 'ahoj'; this.onfocus = 'ahoj'");

      $form->addCheckboxList('discount_type', 'Typ slevy', $discount)
          ->setAttribute('onclick', 'enableIdEl("frm-newProjectForm-discount_amount_percent")');

      $form->addText('discount_amount_percent', 'Výše slevy')->setDisabled()
          ->setType('number')
          ->setAttribute('onchange', 'countFunction(this.form)');
      $form->addText('discount_amount_money', 'Výše slevy')->setDisabled();
      
      $form->addCheckboxList('extra_payment_type', 'Typ příplatku', $extra_payment)
          ->setAttribute('onclick', 'enableIdEl("frm-newProjectForm-extra_payment_amount_percent")');
      
      $form->addText('extra_payment_amount_percent', 'Výše příplatku')->setDisabled()
          ->setType('number')
          ->setAttribute('onchange', 'countFunction(this.form)');
      $form->addText('extra_payment_amount_money', 'Výše příplatku')->setDisabled();
      
      $form->addTextArea('notes', 'Poznámky', 50, 8)
          ->addRule(Form::MAX_LENGTH, 'Poznámky jsou příliš dlouhé.', 10000);
      
      $form->addSubmit('submit', 'Založit poptávku')
              ->setAttribute('class', 'mybutton b_ok');

      $form->onSuccess[] = $this->newProjectFormSubmitted;

      return $form;
  }

  // odeslani noveho projektu
  public function newProjectFormSubmitted(Form $form)
  {
      $this->projectRepository->newProject($form->values->text, $form->values->translator_id);
      $this->flashMessage('Projekt vytvořen.', 'success');
      $this->redirect('this');
  }
  
  
  public function createComponentUploadAggregateInvoiceForm($param) 
  {
      // overeni prihlaseni uzivatele
      if (!$this->getUser()->isLoggedIn()) {
          $this->redirect('Sign:in');
      }
      
      $projects = $this->projectModel->getProjectsForInvocing();
      $project = array();
      foreach ($projects as $key => $value) {
        array_push($project, $value->name);
      }
      
      $form = new Form($this, 'uploadAggregateInvoiceForm');
      
      $form->addCheckboxList('projects', '', $project)
          ->addRule(Form::MIN_LENGTH, 'Musí být vybrán minimálně 1 projekt k fakturaci.', 1);
      
      $form->addUpload('invoice', 'Faktura')
            ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 1 MB.', 1024 * 1024 /* v bytech */);
      
      $form->addSubmit('upload', 'Nahrát');
  }
  
  
  public function createComponentUploadSingleInvoiceForm($param) 
  {
      // overeni prihlaseni uzivatele
      if (!$this->getUser()->isLoggedIn()) {
          $this->redirect('Sign:in');
      }
      
      $form = new Form($this, 'uploadSingleInvoiceForm');
      
      $form->addUpload('invoice', 'Faktura')
            ->addRule(Form::FILLED, 'Není vybrán žádný soubor.')
            //->addRule(Form::MIME_TYPE, 'Faktura musí být dokument PDF.', 'application/pdf, application/x-pdf, application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf')
            ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 1 MB.', 1024 * 1024 /* v bytech */);
      
      $form->addHidden('project_id');
      
      $form->addSubmit('submit', 'Nahrát fakturu')
          ->setAttribute('class', 'mybutton b_upload');
      
      $form->onSuccess[] = $this->uploadSingleInvoiceFormSubmitted;
      
      return $form;
  }
  
  
  // upload jedne faktury
  public function uploadSingleInvoiceFormSubmitted(Form $form)
  {
        if(!$form->values->invoice->isOk()){
            $this->flashMessage('Fakturu se nepodařilo nahrát na server.', 'error');
        }
        
        $project_id = $form->values->project_id;
        $year = date('Y');
        $folder = 'invoices/'.$year;
        $file = $form->values->invoice;
        $filename = $form->values->invoice->name;
        $path = $this->basePath.$folder.'/'.$filename;

        $file->move($path);
        
        $this->projectModel->saveSingleUploadedInvoice($project_id, $year, $filename);
        $this->projectModel->setInvoiceDate($project_id);
        
        $this->flashMessage('Faktura úspěšně nahrána na server.<br>Projekt přesunut mezi nezaplacené projekty.', 'success');
        $this->redirect('this');
  }
  
  
  public function createComponentArchiveYearForm()
  {
      // overeni prihlaseni uzivatele
      if (!$this->getUser()->isLoggedIn()) {
          $this->redirect('Sign:in');
      }
      
      $years = array();
      
      for ($i=date('Y'); $i>=2009; $i--) {
        array_push($years, $i);
      }
      
      $form = new Form($this, 'archiveYearForm');
      
      $form->addSelect('year', 'Rok:')
        ->setItems($years, FALSE)
        ->setDefaultValue($this->archiveYear)
        ->setAttribute('onchange', 'submit()');
      
      $form->onSuccess[] = $this->archiveYearFormSubmitted;
      
      return $form;
  }
  

  // zmena roku v archivu
  public function archiveYearFormSubmitted(Form $form)
  {
      $this->archiveYear = $form->values->year;
      $this->renderArchive($form->values->year);
  }
  
  
  // editace projektu
  public function actionEdit($id)
  {
      $project = $this->projectModel->editproject($id);
      if (!$project) {
          $this->error('Projekt nebyl nalezen.');
      }  
      $this['newprojectForm']->setDefaults($project->toArray());
  }

  // aktivace projektu
  public function actionActivateProject($projectId) {
      $this->projectModel->activateProject($projectId);
      //$this->sendMailToTranslators($projectId);
      //$this->sendMailToCustomer($projectId);
      $this->flashMessage('Projekt přesunut mezi aktuální projekty.', 'success');
      $this->redirect('this');
  }
  
  // projekt dokoncen
  public function actionProjectFinished($projectId) {
      $this->projectModel->projectFinished($projectId);
      //$this->sendMailToTranslators($projectId);
      //$this->sendMailToCustomer($projectId);
      $this->flashMessage('Projekt přesunut mezi projekty k vyfakturování.', 'success');
      $this->redirect('this');
  }
  
  // projekt zaplacen
  public function handleProjectPaid($projectId) {
      $this->projectModel->projectdPaid($projectId);
      //$this->sendMailToCustomer($projectId);
      //$this->flashMessage('Projekt přesunut mezi nevyúčtované projekty.', 'success');
      //$this->redirect('this');
      $this->redrawControl('projects');
  }
  
  // vyuctovani prekladatele
  public function handleAccountTranslator($translator_id, $project_id) {
      $this->projectModel->accountTranslator($translator_id,$project_id);
      //$this->sendMailToTranslators($projectId);
      $this->flashMessage('Překladatel vyúčtován.', 'success');
      if (!$this->isAjax()) {
          $this->redirect('this');
      } else {
          $this->redrawControl('accountTranslator-'.$translator_id);
      }
  }


  // projekt vyuctovan
  public function actionProjectAccounted($projectId) {
      $this->projectModel->projectAccounted($projectId);
      //$this->sendMailToTranslators($projectId);
      $this->flashMessage('Projekt přesunut do archívu.', 'success');
      if (!$this->isAjax()) {
          $this->redirect('this');
      } else {
          $this->redrawControl('projects');
      }
  }
  
  //zruseni projektu
  public function cancelProjectFormSubmitted(Form $form)
  {
      $this->projectModel->cancelProject($form->values->project_id, $form->values->reason);
      $this->redirect('this');
  }
  
  public function actionCancelProject($projectId) {
      $this->taskRepository->cancelProject($projectId);
      $this->flashMessage('Projekt smazán.', 'success');
      $this->redirect('this');
  }

}
