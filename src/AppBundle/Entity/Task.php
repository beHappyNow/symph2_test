<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Category;

class Task
{
    protected $task;
    protected $dueDate;

    /**
     * @Assert\Type(type="AppBundle\Entity\Category")
     * @Assert\Valid()
     */
    protected $category;

    public function __construct()
    {
        $this->task = "To do project on Symfony2!";
        $this->dueDate = new \DateTime('tomorrow');
    }

    public function getTask()
    {
        return $this->task;
    }
    
    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function getCategory()
    {
        return $this->category;
    }
    
    public function setTask($task)
    {
        $this->task = $task;
    }
    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }

    public function setCategory(Category $cat = null)
    {
        $this->category = $cat;
    }
    
}