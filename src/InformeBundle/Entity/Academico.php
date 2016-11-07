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
     * @var int
     *
     * @ORM\Column(name="autor", type="integer")
     */
    private $autor;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=120)
     */
    private $nombre;

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
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank()
     */
    protected $rfc;

    /**
     *
     * @ORM\OneToOne(targetEntity="InformeBundle\Entity\User", inversedBy="academico")
     */
    private $user;

    /**
     * @var array $investigaciones
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Investigacion", mappedBy="academico")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $investigaciones;

    /**
     * @var array $investigacionesautor
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Investigacion", mappedBy="autor")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $investigacionesautor;

    /**
     * @var array $estudiantes
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Estudiantes", mappedBy="academico")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $estudiantes;

    /**
     * @var array $cursos
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Cursos", mappedBy="academico")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $cursos;

    /**
     * @var array $proyectos
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Proyectos", mappedBy="academico")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $proyectos;

    /**
     * @var array $eventos
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Eventos", mappedBy="academico")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $eventos;

    /**
     * @var array $salidas
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Salidas", mappedBy="academico")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $salidas;

    /**
     * @var array $planes
     *
     * @ORM\OneToMany(targetEntity="InformeBundle\Entity\Plan", mappedBy="academico")
     *
     * The mappedBy attribute designates the field in the entity that is the owner of the relationship.
     */
    private $planes;


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
     * Constructor
     */
    public function __construct()
    {
        $this->investigaciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->investigacionesautor = new \Doctrine\Common\Collections\ArrayCollection();

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
     * Add investigacionesautor
     *
     * @param \InformeBundle\Entity\Investigacion $investigacionesautor
     * @return Academico
     */
    public function addInvestigacionesautor(\InformeBundle\Entity\Investigacion $investigacionesautor)
    {
        $this->investigacionesautor[] = $investigacionesautor;

        return $this;
    }

    /**
     * Remove investigacionesautor
     *
     * @param \InformeBundle\Entity\Investigacion $investigacionesautor
     */
    public function removeInvestigacionesautor(\InformeBundle\Entity\Investigacion $investigacionesautor)
    {
        $this->investigacionesautor->removeElement($investigacionesautor);
    }

    /**
     * Get investigacionesautor
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvestigacionesautor()
    {
        return $this->investigacionesautor;
    }

    /**
     * Set autor
     *
     * @param string $autor
     * @return Academico
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return string 
     */
    public function getAutor()
    {
        return $this->autor;
    }

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

    public function getSlug()
    {
        return $this->slug;
    }
}