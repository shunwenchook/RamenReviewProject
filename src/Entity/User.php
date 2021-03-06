<?php
/**
 * Summary comment
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * User entity
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * ID
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Username
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * Password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * Roles
     * @ORM\Column(type="json_array")
     */
    private $roles;


    /**
     * Reviews
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="user")
     */
    private $reviews;

    /**
     * Ramens
     * @ORM\OneToMany(targetEntity="App\Entity\Ramen", mappedBy="user")
     */
    private $ramens;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->ramens = new ArrayCollection();
    }

    /**
     * Returns Review
     * @return Collection|Review[]
     */
    public function getReview()
    {
        return $this->reviews;
    }

    /**
     * Returns Ramen
     * @return Collection|Ramen[]
     */
    public function getRamen()
    {
        return $this->ramens;
    }

    /**
     * returns ID
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * sets ID
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * returns Username
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * sets Username
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * gets password
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * sets password
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * returns roles
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * sets roles
     * @param mixed $roles
     * @return mixed
     */
    public function setRoles($roles)
    {

        $this->roles = $roles;
        return $this;
    }

    /**
     * gets salt
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * erase credentials
     */
    public function eraseCredentials()
    {

    }

    /**
     * Serialize method
     * @see \Serializable::serialize()
     * */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /**
     * Unserialize method
     * @param string $serialized
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            ) = unserialize($serialized);
    }

}
