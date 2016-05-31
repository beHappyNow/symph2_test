<?php
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class CategoryOld
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $name;

    public function __construct()
    {
        $this->name = 'important';
    }
}