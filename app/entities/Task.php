<?php 

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
class Task extends \Kdyby\Doctrine\Entities\BaseEntity
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
    protected $task;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type="integer")
     */
    protected $status;
    
    /**
     * @ORM\ManyToOne(targetEntity="Translator", inversedBy="task", cascade={"persist"})
     * @ORM\JoinColumn(name="commissioned_id")
     */
    protected $translator;

}