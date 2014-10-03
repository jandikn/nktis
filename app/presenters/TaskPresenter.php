<?php
namespace App\Presenters;
use Nette\Application\UI\Form;

/**
 * Translator presenter.
 */
class TaskPresenter extends BasePresenter
{
  
  /** @var App\TaskRepository */
  private $taskModel;
  
  protected function startup()
  {
      parent::startup();
      
      
      if (!$this->getUser()->isLoggedIn()) {
          $this->redirect('Sign:in');
      }
      
      $this->taskModel = $this->context->taskModel;
  }
  

    public function renderDefault()
    {
            $this->template->tasks = $this->taskModel->getTasks();
            $this->template->pom = 1;
    }
  
  protected function createComponentNewTaskForm()
  {
      $commissioned = array (1 => 'Honza', 2 => 'Lukáš');
      
      $form = new Form();
      
      $form->getElementPrototype()->class('ajax');
      
      $form->addTextArea('task', 'Úkol', 160, 3)
          ->addRule(Form::FILLED, 'Je nutné zadat úkol.');
      
      $form->addRadioList('commissioned', 'Pověřený', $commissioned)
          ->addRule(Form::FILLED, 'Je nutné úkol někomu přiřadit.');
      
      $form->addSubmit('submit', 'Vytvořit úkol')
          ->setAttribute('class', 'mybutton b_ok');
      
      $form->onSuccess[] = $this->newTaskFormSubmitted;
      
      return $form;
  }


  public function newTaskFormSubmitted(Form $form)
  {
      $this->taskModel->newTask($form->values);
      $this->flashMessage('Úkol vytvořen.', 'success');
      if (!$this->isAjax()) {
          $this->redirect('this');
      } else {
          $form->setValues(array(), TRUE);
          $this->redrawControl('newTaskForm');
          $this->redrawControl('taskList');
      }
  }
  
  
  public function handleTaskDone($taskID) {
      $this->taskModel->taskDone($taskID);
      $this->flashMessage('Úkol splněn.', 'success');
      if (!$this->isAjax()) {
          $this->redirect('this');
      } else {
          $this->redrawControl('tasks');
      }
  }
  
  
  public function handleDeleteTask($taskID) {
      
      if($this->isAjax()) { echo 'ano'; }
      else { echo 'ne'; }
      die();
      $this->taskModel->deleteTask($taskID);
      $this->template->tasks = $this->taskModel->getTasks();
      $this->redrawControl('tasks');
      /*
      $this->flashMessage('Úkol smazán.', 'success');
      if (!$this->isAjax()) {
          $this->redirect('this');
      } else {
          $this->redrawControl('tasks');
      }
      */
  } 

}
