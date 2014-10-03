<?php

namespace App\Presenters;

use Nette,
	Nette\Application\UI\Form,
	App\Model;


/**
 * Numbers presenter.
 */
class NumbersPresenter extends BasePresenter
{

    /** @var App\ProjectModel */
   private $numbersModel;
   
   // zobrazovany rok
   private $numbersYear;
   
   //aktualni mesic
   private $currentMonth;

    protected function startup()
    {
        parent::startup();

        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }

        $this->numbersModel = $this->context->numbersModel;
    }

    public function renderDefault()
    {
        // firemni udaje
        $this->template->activeTranslators = $this->numbersModel->getNumberOfActiveTranslators();
        $this->template->inactiveTranslators = $this->numbersModel->getNumberOfInactiveTranslators();
        $this->template->numberOfCustomers = $this->numbersModel->getNumberOfCustomers();
        $this->template->numberOfLanguages = $this->numbersModel->getNumberOfLanguages();
        $this->template->numberOfFields = $this->numbersModel->getnumberOfFields();
        
        // celkove udaje
        $this->template->numberOfFinishedProjects = $this->numbersModel->getNumberOfFinishedProjects();
        $this->template->numberOfCancelledProjects = $this->numbersModel->getNumberOfCancelledProjects();
        $this->template->totalSales = $this->numbersModel->getTotalSales();
        $this->template->totalIncome = $this->numbersModel->getTotalIncome();
        $this->template->totalPartnersIncome = $this->numbersModel->getTotalPartnersIncome();
        $this->template->totalObligations = $this->numbersModel->getTotalObligations();
        $this->template->totalDebts = $this->numbersModel->getTotalDebts();

        
        if (!isset($this->numbersYear)) {
          $this->numbersYear = date('Y');
          $this->currentMonth = date('m');
        }
        else {
          if($this->numbersYear != date('Y')) {
              $this->currentMonth = 12;
          }
          else {
              $this->currentMonth = date('m');
          }
        }

        $this->template->current_year = $this->numbersYear;
        $this->template->current_month = $this->currentMonth;
        $this->template->number_of_company_months = 4 + (idate('Y') - 2010) * 12 + date('n');

        // rocni udaje
        $this->template->numberOfYearsProjects = $this->numbersModel->getNumberOfYearsProjects($this->numbersYear);
        $this->template->numberOfCanceledYearsProjects = $this->numbersModel->getNumberOfYearsProjects($this->numbersYear);
        $this->template->yearsSales = $this->numbersModel->getYearsSales($this->numbersYear);
        $this->template->yearsIncome = $this->numbersModel->getYearsIncome($this->numbersYear);
        $this->template->yearsPartnersIncome = $this->numbersModel->getYearsPartnersIncome($this->numbersYear);
        $this->template->yearsObligations = $this->numbersModel->getYearsObligations($this->numbersYear);
        $this->template->yearsDebts = $this->numbersModel->getYearsDebts($this->numbersYear);

        // mesicni udaje
        $years_months = array(1 => 'Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec');
        $months = array();

        for($i=1; $i<=$this->currentMonth; $i++) {
            $month_number = sprintf("%02s", $i);
            $month['name'] = $years_months[$i];
            $month['projects'] = $this->numbersModel->getNumberOfMonthProjects($this->numbersYear, $month_number);
            $month['canceled_projects'] = $this->numbersModel->getNumberOfMonthCancelledProjects($this->numbersYear, $month_number);
            $month['sales'] = $this->numbersModel->getMonthSales($this->numbersYear, $month_number);
            $month['income'] = $this->numbersModel->getMonthIncome($this->numbersYear, $month_number);
            $month['partners_income'] = $this->numbersModel->getMonthPartnersIncome($this->numbersYear, $month_number);
            //$month['languages'] = $this->numbersModel->getLanguagesProfits($this->numbersYear, $month_number);
            array_push($months, $month);
        }

        $this->template->months =  $months;
    }
    
    
    public function createComponentNumbersYearForm()
    {
        // overeni prihlaseni uzivatele
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }

        $years = array();

        for ($i=date('Y'); $i>=2009; $i--) {
          array_push($years, $i);
        }

        $form = new Form($this, 'numbersYearForm');

        $form->addSelect('year', 'Rok:')
          ->setItems($years, FALSE)
          ->setDefaultValue($this->numbersYear)
          ->setAttribute('onchange', 'submit()');

        $form->onSuccess[] = $this->numbersYearFormSubmitted;

        return $form;
    }


    // zmena roku v archivu
    public function numbersYearFormSubmitted(Form $form)
    {
        $this->numbersYear = $form->values->year;
        $this->renderDefault($form->values->year);
    }

}
