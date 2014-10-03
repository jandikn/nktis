<?php

namespace App\Presenters;

use Nette,
	Nette\Application\UI\Form,
	App\Model;


/**
 * Customer presenter.
 */
class CustomerPresenter extends BasePresenter
{

   /** @var App\ProjectModel */
  private $customerModel;


  protected function startup()
  {
      parent::startup();
  
      if (!$this->getUser()->isLoggedIn()) {
          $this->redirect('Sign:in');
      }
  
      $this->customerModel = $this->context->customerModel;
  }


	public function renderDefault()
	{
		  $this->template->customers = $this->customerModel->getCustomers();
	}


	public function renderBlacklist()
	{
		  $this->template->customers = $this->customerModel->getBlacklistCustomers();
	}

	protected function createComponentNewCustomerForm()
  {
      // overeni prihlaseni uzivatele
      if (!$this->getUser()->isLoggedIn()) {
          $this->redirect('Sign:in');
      }

      $form = new Form($this, 'newCustomerForm');

      $form->addText('title', 'Titul', 10);

      $form->addText('name', 'Jméno', 40)
          ->addRule(Form::FILLED, 'Je nutné zadat jméno zákazníka.');

      $form->addText('surname', 'Příjmení', 40)
          ->addRule(Form::FILLED, 'Je nutné zadat příjmení zákazníka.');

      $form->addText('company', 'Společnost', 40);

      $form->addText('web', 'Webové stránky', 40);

      $form->addText('email', 'E-mail', 40)
          ->setType('email')
          ->addRule(Form::FILLED, 'Je nutné zadat email zákazníka.')
          ->addRule(Form::EMAIL, 'E-mail musí být ve tvaru user@example.com.');

      $form->addText('tel_preset', '')
          ->addRule(Form::INTEGER, 'Předvolba musí obsahovat pouze čísla.')
          ->addRule(Form::FILLED, 'Je nutné zadat telefonní předvolbu.')
          ->addRule(Form::MIN_LENGTH, 'Telefonní předvolba musí mít délku alespoň %d číslic', 5)
          ->setDefaultValue('00420');

      $form->addText('telephone', 'Telefon')
          ->addRule(Form::INTEGER, 'Telefon musí obsahovat pouze čísla.')
          ->addRule(Form::FILLED, 'Je nutné zadat telefon zákazníka.')
          ->addRule(Form::MIN_LENGTH, 'Telefon musí mít délku alespoň %d číslic', 9);

      $form->addText('address', 'Adresa', 40)
          ->addRule(Form::FILLED, 'Je nutné zadat adresu zákazníka.');

      $form->addText('postcode', 'PSČ', 40)
          ->setType('number')
          ->addRule(Form::MIN_LENGTH, 'PSČ musí mít alespoň %d číslic', 5)
          ->addRule(Form::INTEGER, 'PSČ musí být celé číslo.')
          ->addRule(Form::FILLED, 'Je nutné zadat PSČ zákazníka.');

      $form->addText('city', 'Město', 40)
          ->addRule(Form::FILLED, 'Je nutné zadat město zákazníka.');

      $form->addText('reg_no', 'IČ', 40)
          ->setType('number')
          ->addRule(Form::LENGTH, 'IČ musí mít délku %d číslic', 8)
          ->addRule(Form::INTEGER, 'IČ musí být celé číslo.');

      $form->addText('tax_id_no', 'DIČ', 40)
          ->addRule(Form::PATTERN, 'DIČ je ve špatném tvaru.', '^([A-Z]{2})([0-9]{1,8})$');

      $form->addRadiolist('legal_form', 'Právní forma', array('corporate' => 'Právnická osoba', 'individual' => 'Fyzická osoba', 'abroad' => 'Zahraničí'))
          ->setDefaultValue('corporate');

      $form->addRadiolist('due_date', 'Splatnost faktur', array('14' => '14 dní', '30' => '30 dní'))
          ->setDefaultValue('14');

      $form->addTextArea('notes', 'Poznámky', 40, 6)
          ->addRule(Form::MAX_LENGTH, 'Poznámka je příliš dlouhá.', 10000);

      $form->addSubmit('submit', 'Uložit zákazníka')
          ->setAttribute('class', 'mybutton b_ok');

      $form->onSuccess[] = $this->newCustomerSubmitted;

      return $form;
  }

  // pridani noveho zakaznika
  public function newCustomerSubmitted(Form $form)
  {
      $values = $form->getValues();
      $customerId = $this->getParameter('id');

      if ($customerId) {
          $customer = $this->customerModel->editCustomer($customerId);
          $customer->update($values);
      } else {
          $customer = $this->customerModel->newCustomer($values);
      }

      $this->flashMessage('Zákazník úspěšně uložen.', 'success');
      $this->redirect('default');
  }

  // editace zakaznika
  public function actionEdit($id)
  {
      $customer = $this->customerModel->editCustomer($id);
      if (!$customer) {
          $this->error('Zákazník nebyl nalezen.');
      }  
      $this['newCustomerForm']->setDefaults($customer->toArray());
  }

  // smazani zakaznika
  public function actionDelete($id)
  {
      $this->customerModel->deleteCustomer($id);

      $this->flashMessage('Zákazník přesunut do blacklistu.', 'success');
      $this->redirect('default');
  }

  // smazani zakaznika
  public function actionActivate($id)
  {
      $this->customerModel->activateCustomer($id);

      $this->flashMessage('Zákazník obnoven.', 'success');
      $this->redirect('default');
  }

}
