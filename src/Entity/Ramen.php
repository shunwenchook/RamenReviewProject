<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\RamenRepository")
 * @ORM\Table(name="ramen")
 */
class Ramen
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $ingrediants;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $pricerange;


    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="ramen")
     */
    private $reviews;


    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getIngrediants()
    {
        return $this->ingrediants;
    }

    /**
     * @param mixed $ingrediants
     */
    public function setIngrediants($ingrediants)
    {
        $this->ingrediants = $ingrediants;
    }

    /**
     * @return mixed
     */
    public function getPricerange()
    {
        return $this->pricerange;
    }

    /**
     * @param mixed $pricerange
     */
    public function setPricerange($pricerange)
    {
        $this->pricerange = $pricerange;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews()
    {
        return $this->reviews;
    }

}