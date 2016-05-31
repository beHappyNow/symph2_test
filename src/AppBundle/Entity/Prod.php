<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prod
 *
 * @ORM\Table(name="prod")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProdRepository")
 */
class Prod
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="dsf", type="string", length=255)
     */
    private $dsf;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Prod
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set dsf
     *
     * @param string $dsf
     *
     * @return Prod
     */
    public function setDsf($dsf)
    {
        $this->dsf = $dsf;

        return $this;
    }

    /**
     * Get dsf
     *
     * @return string
     */
    public function getDsf()
    {
        return $this->dsf;
    }
}
