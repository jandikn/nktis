<?php

namespace App;
use Nette;

/**
 * Tabulka task
 */
class TaskModel extends Model
{

  public function getTasks()
  {
      return $this->findAll()->order('date DESC');
  }
  
  
  public function newTask($task)
  {
      return $this->getTable()->insert(array(
          'task' => $task->task,
          'creator_id' => $task->commissioned,
          'commissioned_id' => $task->commissioned,
          'date' => new \DateTime()
      ));
  }
  
  
  public function taskDone($taskID)
  {
      $this->getTable()->where('id', $taskID)->update(array('status' => 1));
  }
  
  
  public function deleteTask($taskID)
  {
      $this->getTable()->where('id', $taskID)->fetch()->delete();
  }
  
}
