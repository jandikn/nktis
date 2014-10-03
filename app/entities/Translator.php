<?php 

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

/**
 * @ORM\Entity
 * @method Task[] getTasks
 */
class Translator extends \Kdyby\Doctrine\Entities\BaseEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $email;
    
    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="translator", cascade={"persist"})
     */
    protected $tasks;
    
    public function getUncompletedTasks() {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('status', 0));
        return $this->tasks->matching($criteria);
    }
    
    public function getUncompletedTasksCount() {
        return count($this->getUncompletedTasks());
    }
   

}