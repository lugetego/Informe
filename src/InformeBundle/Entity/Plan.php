<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plan
 *
 * @ORM\Table(name="plan")
 * @ORM\Entity(repositoryClass="InformeBundle\Repository\PlanRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Plan
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
     * @var academico
     * @ORM\ManyToOne(targetEntity="Academico", inversedBy="investigaciones")
     * @ORM\JoinColumn(name="academico_id", referencedColumnName="id")
     */
    private $academico;

    /**
     * @var string
     *
     * @ORM\Column(name="investigacion", type="text", length=10000, nullable=true)
     */
    private $investigacion;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiantes", type="text", length=10000, nullable=true)
     */
    private $estudiantes;

    /**
     * @var string
     *
     * @ORM\Column(name="cursos", type="text", length=10000, nullable=true)
     */
    private $cursos;

    /**
     * @var string
     *
     * @ORM\Column(name="proyectos", type="text", length=10000, nullable=true)
     */
    private $proyectos;

    /**
     * @var string
     *
     * @ORM\Column(name="eventos", type="text", length=10000, nullable=true)
     */
    private $eventos;

    /**
     * @var string
     *
     * @ORM\Column(name="salidas", type="text", length=10000, nullable=true)
     */
    private $salidas;

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

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setModified(new \DateTime());
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
     * Set investigacion
     *
     * @param string $investigacion
     * @return Plan
     */
    public function setInvestigacion($investigacion)
    {
        $this->investigacion = $investigacion;

        return $this;
    }

    /**
     * Get investigacion
     *
     * @return string 
     */
    public function getInvestigacion()
    {
        return $this->investigacion;
    }

    /**
     * Set estudiantes
     *
     * @param string $estudiantes
     * @return Plan
     */
    public function setEstudiantes($estudiantes)
    {
        $this->estudiantes = $estudiantes;

        return $this;
    }

    /**
     * Get estudiantes
     *
     * @return string 
     */
    public function getEstudiantes()
    {
        return $this->estudiantes;
    }

    /**
     * Set cursos
     *
     * @param string $cursos
     * @return Plan
     */
    public function setCursos($cursos)
    {
        $this->cursos = $cursos;

        return $this;
    }

    /**
     * Get cursos
     *
     * @return string 
     */
    public function getCursos()
    {
        return $this->cursos;
    }

    /**
     * Set proyectos
     *
     * @param string $proyectos
     * @return Plan
     */
    public function setProyectos($proyectos)
    {
        $this->proyectos = $proyectos;

        return $this;
    }

    /**
     * Get proyectos
     *
     * @return string 
     */
    public function getProyectos()
    {
        return $this->proyectos;
    }

    /**
     * Set eventos
     *
     * @param string $eventos
     * @return Plan
     */
    public function setEventos($eventos)
    {
        $this->eventos = $eventos;

        return $this;
    }

    /**
     * Get eventos
     *
     * @return string 
     */
    public function getEventos()
    {
        return $this->eventos;
    }

    /**
     * Set salidas
     *
     * @param string $salidas
     * @return Plan
     */
    public function setSalidas($salidas)
    {
        $this->salidas = $salidas;

        return $this;
    }

    /**
     * Get salidas
     *
     * @return string 
     */
    public function getSalidas()
    {
        return $this->salidas;
    }

    /**
     * Set academico
     *
     * @param \InformeBundle\Entity\academico $academico
     */
    public function setAcademico($academico)
    {
        $this->academico = $academico;
    }

    /**
     * Get academico
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcademico()
    {
        return $this->academico;
    }

}
