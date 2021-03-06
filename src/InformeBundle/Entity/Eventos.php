<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Eventos
 *
 * @ORM\Table(name="eventos")
 * @ORM\Entity(repositoryClass="InformeBundle\Repository\EventosRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Eventos
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
     * @ORM\ManyToOne(targetEntity="Informe", inversedBy="eventos")
     * @ORM\JoinColumn(name="informe_id", referencedColumnName="id")
     */
    private $informe;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;

    /**
     * @var bool
     *
     * @ORM\Column(name="organizador", type="boolean")
     */
    private $organizador;

    /**
     * @var bool
     *
     * @ORM\Column(name="nacional", type="boolean")
     */
    private $nacional;

    /**
     * @var bool
     *
     * @ORM\Column(name="invitacion", type="boolean")
     */
    private $invitacion;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=255)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="institucion", type="string", length=255)
     */
    private $institucion;

    /**
     * @var string
     *
     * @ORM\Column(name="platica", type="string", length=255, nullable=true)
     */
    private $platica;

    /**
     * @var string
     *
     * @ORM\Column(name="actividad", type="string", length=255, nullable=true)
     */
    private $actividad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="date")
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="date")
     */
    private $fin;
    /**
     * @var string
     *
     * @ORM\Column(name="informacion", type="string", length=255, nullable=true)
     */
    private $informacion;

    /**
     * @var bool
     *
     * @ORM\Column(name="divulgacion", type="boolean")
     */
    private $divulgacion;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Eventos
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
     * Set tipo
     *
     * @param string $tipo
     * @return Eventos
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set organizador
     *
     * @param boolean $organizador
     * @return Eventos
     */
    public function setOrganizador($organizador)
    {
        $this->organizador = $organizador;

        return $this;
    }

    /**
     * Get organizador
     *
     * @return boolean
     */
    public function getOrganizador()
    {
        return $this->organizador;
    }

    /**
     * Set nacional
     *
     * @param boolean $nacional
     * @return Eventos
     */
    public function setNacional($nacional)
    {
        $this->nacional = $nacional;

        return $this;
    }

    /**
     * Get nacional
     *
     * @return boolean 
     */
    public function getNacional()
    {
        return $this->nacional;
    }

    /**
     * Set invitacion
     *
     * @param boolean $invitacion
     * @return Eventos
     */
    public function setInvitacion($invitacion)
    {
        $this->invitacion = $invitacion;

        return $this;
    }

    /**
     * Get invitacion
     *
     * @return boolean
     */
    public function getInvitacion()
    {
        return $this->invitacion;
    }

    /**
     * Set pais
     *
     * @param string $pais
     * @return Eventos
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set institucion
     *
     * @param string $institucion
     * @return Eventos
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return string 
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Set platica
     *
     * @param string $platica
     * @return Eventos
     */
    public function setPlatica($platica)
    {
        $this->platica = $platica;

        return $this;
    }

    /**
     * Get platica
     *
     * @return string 
     */
    public function getPlatica()
    {
        return $this->platica;
    }

    /**
     * Set actividad
     *
     * @param string $actividad
     * @return Eventos
     */
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return string 
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set inicio
     *
     * @param \DateTime $inicio
     * @return Salidas
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;

        return $this;
    }

    /**
     * Get inicio
     *
     * @return \DateTime
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     * @return Salidas
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }


    /**
     * Set informacion
     *
     * @param string $informacion
     * @return Eventos
     */
    public function setInformacion($informacion)
    {
        $this->informacion = $informacion;

        return $this;
    }

    /**
     * Get informacion
     *
     * @return string 
     */
    public function getInformacion()
    {
        return $this->informacion;
    }

    /**
     * @return boolean
     */
    public function isDivulgacion()
    {
        return $this->divulgacion;
    }

    /**
     * @param boolean $divulgacion
     */
    public function setDivulgacion($divulgacion)
    {
        $this->divulgacion = $divulgacion;
    }



    /**
     * Get divulgacion
     *
     * @return boolean 
     */
    public function getDivulgacion()
    {
        return $this->divulgacion;
    }

    /**
     * Set informe
     *
     * @param \InformeBundle\Entity\Informe $informe
     * @return Eventos
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
}
