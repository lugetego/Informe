<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Academico
 *
 * @ORM\Table(name="academico")
 * @ORM\Entity(repositoryClass="InformeBundle\Repository\AcademicoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Academico
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
     * @ORM\Column(name="nombre", type="string", length=120)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Informe", mappedBy="academico", cascade={"persist"})
     */
    private $informes;


    public function __construct() {
        $this->informes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=120)
     */
    private $apellido;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    protected $nacimiento;

    /**
     * @ORM\Column(type="string", length=13)
     * @Assert\NotBlank()
     */
    protected $rfc;

    /**
     *
     * @ORM\OneToOne(targetEntity="InformeBundle\Entity\User", inversedBy="academico")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified;

    /**
     * Set created
     *
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setCreated(new \DateTime());
        $this->setModified(new \DateTime());
    }

//    /**
//     * @ORM\PreUpdate
//     */
//    public function preUpdate()
//    {
//        $this->setModified(new \DateTime());
//    }

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
     * Set nombre
     *
     * @param string $nombre
     * @return Academico
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Academico
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @return mixed
     */
    public function getNacimiento()
    {
        return $this->nacimiento;
    }

    /**
     * @param mixed $nacimiento
     */
    public function setNacimiento($nacimiento)
    {
        $this->nacimiento = $nacimiento;
    }

    /**
     * @return mixed
     */
    public function getRfc()
    {
        return $this->rfc;
    }

    /**
     * @param mixed $rfc
     */
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;
    }


    /**
     * Set user
     *
     * @param \InformeBundle\Entity\User $user
     * @return Academico
     */
    public function setUser(\InformeBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \InformeBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString()
    {
        return $this->nombre;

    }


    /**
     * Set id
     *
     * @param integer $id
     * @return Academico
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Add informes
     *
     * @param \InformeBundle\Entity\Informe $informes
     * @return Academico
     */
    public function addInforme(\InformeBundle\Entity\Informe $informes)
    {
        $this->informes[] = $informes;

        return $this;
    }

    /**
     * Remove informes
     *
     * @param \InformeBundle\Entity\Informe $informes
     */
    public function removeInforme(\InformeBundle\Entity\Informe $informes)
    {
        $this->informes->removeElement($informes);
    }

    /**
     * Get informes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInformes()
    {
        return $this->informes;
    }

    /**
     * @var array $planes
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Plan", mappedBy="academico")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $planes;

    /**
     * Add planes
     *
     * @param \InformeBundle\Entity\Plan $planes
     * @return Academico
     */
    public function addPlane(\InformeBundle\Entity\Plan $planes)
    {
        $this->planes[] = $planes;

        return $this;
    }

    /**
     * Remove planes
     *
     * @param \InformeBundle\Entity\Plan $planes
     */
    public function removePlane(\InformeBundle\Entity\Plan $planes)
    {
        $this->planes->removeElement($planes);
    }

    /**
     * Get planes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanes()
    {
        return $this->planes;
    }


}