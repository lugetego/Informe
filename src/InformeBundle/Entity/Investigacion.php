<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;


/**
 * Investigacion
 *
 * @ORM\Table(name="investigacion")
 * @ORM\Entity(repositoryClass="InformeBundle\Repository\InvestigacionRepository")
 */
class Investigacion
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
     * @var autor
     * @ORM\Column(name="autor", type="integer")
     * @ORM\ManyToOne(targetEntity="Academico", inversedBy="investigacionesautor")
     * @ORM\JoinColumn(name="autor_id", referencedColumnName="id")
     */
    private $autor;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=120)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="autores", type="string", length=255)
     */
    private $autores;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=255)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="pags", type="string", length=255)
     */
    private $pags;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen", type="string", length=255)
     */
    private $volumen;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="issn", type="string", length=255)
     */
    private $issn;

    /**
     * @var string
     *
     * @ORM\Column(name="proyectos", type="string", length=255)
     */
    private $proyectos;

    /**
     * @var bool
     *
     * @ORM\Column(name="indizado", type="boolean", nullable=true)
     */
    private $indizado;

    /**
     * @var string
     *
     * @ORM\Column(name="revista", type="string", length=255)
     */
    private $revista;


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
     * Set tipo
     *
     * @param string $tipo
     * @return Investigacion
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
     * Set titulo
     *
     * @param string $titulo
     * @return Investigacion
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set autores
     *
     * @param string $autores
     * @return Investigacion
     */
    public function setAutores($autores)
    {
        $this->autores = $autores;

        return $this;
    }

    /**
     * Get autores
     *
     * @return string 
     */
    public function getAutores()
    {
        return $this->autores;
    }

    /**
     * Set year
     *
     * @param string $year
     * @return Investigacion
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return string 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set pags
     *
     * @param string $pags
     * @return Investigacion
     */
    public function setPags($pags)
    {
        $this->pags = $pags;

        return $this;
    }

    /**
     * Get pags
     *
     * @return string 
     */
    public function getPags()
    {
        return $this->pags;
    }

    /**
     * Set volumen
     *
     * @param string $volumen
     * @return Investigacion
     */
    public function setVolumen($volumen)
    {
        $this->volumen = $volumen;

        return $this;
    }

    /**
     * Get volumen
     *
     * @return string 
     */
    public function getVolumen()
    {
        return $this->volumen;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return Investigacion
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Investigacion
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set issn
     *
     * @param string $issn
     * @return Investigacion
     */
    public function setIssn($issn)
    {
        $this->issn = $issn;

        return $this;
    }

    /**
     * Get issn
     *
     * @return string 
     */
    public function getIssn()
    {
        return $this->issn;
    }

    /**
     * Set proyectos
     *
     * @param string $proyectos
     * @return Investigacion
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
     * Set indizado
     *
     * @param boolean $indizado
     * @return Investigacion
     */
    public function setIndizado($indizado)
    {
        $this->indizado = $indizado;

        return $this;
    }

    /**
     * Get indizado
     *
     * @return boolean 
     */
    public function getIndizado()
    {
        return $this->indizado;
    }

    /**
     * Set revista
     *
     * @param string $revista
     * @return Investigacion
     */
    public function setRevista($revista)
    {
        $this->revista = $revista;

        return $this;
    }

    /**
     * Get revista
     *
     * @return string 
     */
    public function getRevista()
    {
        return $this->revista;
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





    /**
     * Set autor
     *
     * @param integer $autor
     * @return Investigacion
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return integer 
     */
    public function getAutor()
    {
        return $this->autor;
    }
}
