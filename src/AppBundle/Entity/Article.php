<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime as DT;
use Symfony\Component\Validator\Constraints as Assert;



class Article
{

    private $id;

    /**

     * @Assert\NotBlank()
     * @Assert\Length(min=6, groups={"reuse"})
     * @var string
     */
    protected $title;

    /**

     * @Assert\NotBlank()
     * @Assert\Length(min=50, groups={"registration"})
     * @var string
     */
    protected $body;
    /**

     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     * @var \DateTime
     */
    protected $date;
    protected $country;
    /**

     */
    protected $published;

    /**
     * @Assert\Type(type="AppBundle\Entity\Category")
     * @Assert\Valid()
     */
    protected $category;

    public function __construct()
    {
        $this->title = "testTitle";
        $this->body = "testBody";
        $this->date = new \DateTime();
        $this->category = new Category();
        $this->published = false;
        $this->country = 'UA';
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function hasPublished()
    {
        return $this->published;
    }
    public function getCountry()
    {
        return $this->country;
    }

    public function getCategory()
    {
        return $this->category;
    }


    public function setTitle($param)
    {
        $this->title = $param;
    }

    public function setBody($param)
    {
        $this->body = $param;
    }

    public function setDate($param)
    {
        $this->date = $param;
    }

    public function setPublished($param)
    {
        $this->published = $param;
    }

    public function setCountry($param)
    {
        $this->country = $param;
    }

    public function setCategory(Category $cat = null)
    {
        $this->category = $cat;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get published
     *
     * @return \Boolean
     */
    public function getPublished()
    {
        return $this->published;
    }
}
