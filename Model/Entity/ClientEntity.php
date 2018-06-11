<?php
namespace Model\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Client Entity
 * @package Model\Entity
 * @ORM\Entity(repositoryClass="Model\ClientRepository")
 * @ORM\Table(name="client")
 */
class Client
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     **/
    private $firstname;
    

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    /**
     * @param mixed $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }
}