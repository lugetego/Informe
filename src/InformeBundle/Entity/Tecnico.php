<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tecnico
 *
 * @ORM\Table(name="tecnico")
 * @ORM\Entity(repositoryClass="InformeBundle\Repository\TecnicoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Tecnico
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
     * @var informe
     * @ORM\ManyToOne(targetEntity="Informe", inversedBy="tecnicos")
     * @ORM\JoinColumn(name="informe_id", referencedColumnName="id")
     */
    private $informe;

    /**
     * @var string
     *
     * @ORM\Column(name="informe", type="text", nullable=true)
     */
    private $informeAnual;

    /**
     * @var string
     *
     * @ORM\Column(name="plan", type="text", nullable=true)
     */
    private $plan;

   /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified;


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
     * Set plan
     *
     * @param string $plan
     * @return Tecnico
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return string 
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Tecnico
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
     * @return Tecnico
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
     * Set academico
     *
     * @param \InformeBundle\Entity\Academico $academico
     * @return Tecnico
     */
    public function setAcademico(\InformeBundle\Entity\Academico $academico = null)
    {
        $this->academico = $academico;

        return $this;
    }

    /**
     * Get academico
     *
     * @return \InformeBundle\Entity\Academico 
     */
    public function getAcademico()
    {
        return $this->academico;
    }

    /**
     * Set informeAnual
     *
     * @param string $informeAnual
     * @return Tecnico
     */
    public function setInformeAnual($informeAnual)
    {
        $this->informeAnual = $informeAnual;

        return $this;
    }

    /**
     * Get informeAnual
     *
     * @return string 
     */
    public function getInformeAnual()
    {
        return $this->informeAnual;
    }

    /**
     * Set informe
     *
     * @param \InformeBundle\Entity\Informe $informe
     * @return Tecnico
     */
    public function setInforme(\InformeBundle\Entity\Informe $informe = null)
    {
        $this->informe = $informe;

        return $this;
    }

    /**
     * Get informe
     *
     * @return \InformeBundle\Entity\Informe 
     */
    public function getInforme()
    {
        return $this->informe;
    }

    /**
     * Set dictamen
     *
     * @param string $dictamen
     * @return Informe
     */
    public function setDictamen($dictamen)
    {
        $this->dictamen = $dictamen;

        return $this;
    }

    /**
     * Get dictamen
     *
     * @return string
     */
    public function getDictamen()
    {
        return $this->dictamen;
    }

}
