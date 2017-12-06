<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Informe
 *
 * @ORM\Table(name="informe")
 * @ORM\Entity(repositoryClass="InformeBundle\Repository\InformeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Informe
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
     * @ORM\ManyToOne(targetEntity="Academico", inversedBy="informes")
     * @ORM\JoinColumn(name="academico_id", referencedColumnName="id")
     */
    private $academico;

    /**
     * @var bool
     *
     * @ORM\Column(name="enviado", type="boolean", nullable=true)
     */
    private $enviado;


    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $dictamen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="anio", type="string", length=255)
     */
    private $anio;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified;

    /**
     * @var array $cursos
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Cursos", mappedBy="informe")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $cursos;

    /**
     * @var array $investigaciones
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Investigacion", mappedBy="informe")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $investigaciones;

    /**
     * @var array $estudiantes
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Estudiantes", mappedBy="informe")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $estudiantes;

    /**
     * @var array $posdocs
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Posdoc", mappedBy="informe")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $posdocs;

    /**
     * @var array $proyectos
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Proyectos", mappedBy="informe")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $proyectos;

    /**
     * @var array $eventos
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Eventos", mappedBy="informe")
     * @ORM\OrderBy({"inicio" = "ASC"})
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $eventos;

    /**
     * @var array $salidas
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Salidas", mappedBy="informe")
     * @ORM\OrderBy({"inicio" = "ASC"})
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $salidas;

    /**
     * @var array $tecnicos
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Tecnico", mappedBy="informe")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $tecnicos;

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
     * Set academico
     *
     * @param string $academico
     * @return Informe
     */
    public function setAcademico($academico)
    {
        $this->academico = $academico;

        return $this;
    }

    /**
     * Get academico
     *
     * @return string 
     */
    public function getAcademico()
    {
        return $this->academico;
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

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Informe
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }



    /**
     * Set anio
     *
     * @param string $anio
     * @return Informe
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
     *
     * @return string 
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Add cursos
     *
     * @param \InformeBundle\Entity\Cursos $cursos
     * @return Academico
     */
    public function addCurso(\InformeBundle\Entity\Cursos $cursos)
    {
        $this->cursos[] = $cursos;

        return $this;
    }

    /**
     * Remove cursos
     *
     * @param \InformeBundle\Entity\Cursos $cursos
     */
    public function removeCurso(\InformeBundle\Entity\Cursos $cursos)
    {
        $this->cursos->removeElement($cursos);
    }

    /**
     * Get cursos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCursos()
    {
        return $this->cursos;
    }

    /**
     * @return mixed
     */
    public function getAprobado()
    {
        return $this->aprobado;
    }

    /**
     * @param mixed $aprobado
     */
    public function setAprobado($aprobado)
    {
        $this->aprobado = $aprobado;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->investigaciones = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Get investigaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvestigaciones()
    {
        return $this->investigaciones;
    }

    /**
     * Add investigaciones
     *
     * @param \InformeBundle\Entity\Investigacion $investigaciones
     * @return Academico
     */
    public function addInvestigacione(\InformeBundle\Entity\Investigacion $investigaciones)
    {
        $this->investigaciones[] = $investigaciones;

        return $this;
    }

    /**
     * Remove investigaciones
     *
     * @param \InformeBundle\Entity\Investigacion $investigaciones
     */
    public function removeInvestigacione(\InformeBundle\Entity\Investigacion $investigaciones)
    {
        $this->investigaciones->removeElement($investigaciones);
    }

    /**
     * Add estudiantes
     *
     * @param \InformeBundle\Entity\Estudiantes $estudiantes
     * @return Academico
     */
    public function addEstudiante(\InformeBundle\Entity\Estudiantes $estudiantes)
    {
        $this->estudiantes[] = $estudiantes;

        return $this;
    }

    /**
     * Remove estudiantes
     *
     * @param \InformeBundle\Entity\Estudiantes $estudiantes
     */
    public function removeEstudiante(\InformeBundle\Entity\Estudiantes $estudiantes)
    {
        $this->estudiantes->removeElement($estudiantes);
    }

    /**
     * Get estudiantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstudiantes()
    {
        return $this->estudiantes;
    }


    /**
     * Add proyectos
     *
     * @param \InformeBundle\Entity\Proyectos $proyectos
     * @return Academico
     */
    public function addProyecto(\InformeBundle\Entity\Proyectos $proyectos)
    {
        $this->proyectos[] = $proyectos;

        return $this;
    }

    /**
     * Remove proyectos
     *
     * @param \InformeBundle\Entity\Proyectos $proyectos
     */
    public function removeProyecto(\InformeBundle\Entity\Proyectos $proyectos)
    {
        $this->proyectos->removeElement($proyectos);
    }

    /**
     * Get proyectos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProyectos()
    {
        return $this->proyectos;
    }

    /**
     * Add eventos
     *
     * @param \InformeBundle\Entity\Eventos $eventos
     * @return Academico
     */
    public function addEvento(\InformeBundle\Entity\Eventos $eventos)
    {
        $this->eventos[] = $eventos;

        return $this;
    }

    /**
     * Remove eventos
     *
     * @param \InformeBundle\Entity\Eventos $eventos
     */
    public function removeEvento(\InformeBundle\Entity\Eventos $eventos)
    {
        $this->eventos->removeElement($eventos);
    }

    /**
     * Get eventos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventos()
    {
        return $this->eventos;
    }

    /**
     * Add salidas
     *
     * @param \InformeBundle\Entity\Salidas $salidas
     * @return Academico
     */
    public function addSalida(\InformeBundle\Entity\Salidas $salidas)
    {
        $this->salidas[] = $salidas;

        return $this;
    }

    /**
     * Remove salidas
     *
     * @param \InformeBundle\Entity\Salidas $salidas
     */
    public function removeSalida(\InformeBundle\Entity\Salidas $salidas)
    {
        $this->salidas->removeElement($salidas);
    }

    /**
     * Get salidas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSalidas()
    {
        return $this->salidas;
    }

    public function getSlug()
    {
        return $this->slug;
    }



    /**
     * Add posdocs
     *
     * @param \InformeBundle\Entity\Posdoc $posdocs
     * @return Academico
     */
    public function addPosdoc(\InformeBundle\Entity\Posdoc $posdocs)
    {
        $this->posdocs[] = $posdocs;

        return $this;
    }

    /**
     * Remove posdocs
     *
     * @param \InformeBundle\Entity\Posdoc $posdocs
     */
    public function removePosdoc(\InformeBundle\Entity\Posdoc $posdocs)
    {
        $this->posdocs->removeElement($posdocs);
    }

    /**
     * Get posdocs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosdocs()
    {
        return $this->posdocs;
    }

    /**
     * Add tecnicos
     *
     * @param \InformeBundle\Entity\Tecnico $tecnicos
     * @return Academico
     */
    public function addTecnico(\InformeBundle\Entity\Tecnico $tecnicos)
    {
        $this->tecnicos[] = $tecnicos;

        return $this;
    }

    /**
     * Remove tecnicos
     *
     * @param \InformeBundle\Entity\Tecnico $tecnicos
     */
    public function removeTecnico(\InformeBundle\Entity\Tecnico $tecnicos)
    {
        $this->tecnicos->removeElement($tecnicos);
    }

    /**
     * Get tecnicos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTecnicos()
    {
        return $this->tecnicos;
    }

    /**
     * @return boolean
     */
    public function isEnviado()
    {
        return $this->enviado;
    }

    /**
     * @param boolean $enviado
     */
    public function setEnviado($enviado)
    {
        $this->enviado = $enviado;
    }
}
