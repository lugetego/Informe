<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estudiantes
 *
 * @ORM\Table(name="estudiantes")
 * @ORM\Entity(repositoryClass="InformeBundle\Repository\EstudiantesRepository")
 */
class Estudiantes
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
     * @ORM\ManyToOne(targetEntity="Academico", inversedBy="estudiantes")
     * @ORM\JoinColumn(name="academico_id", referencedColumnName="id")
     */
    private $academico;


    /**
     * @var string
     *
     * @ORM\Column(name="programa", type="string", length=255)
     */
    private $programa;

    /**
     * @var string
     *
     * @ORM\Column(name="tesis", type="string", length=255)
     */
    private $tesis;

    /**
     * @var string
     *
     * @ORM\Column(name="alumno", type="string", length=255)
     */
    private $alumno;


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
     * Set programa
     *
     * @param string $programa
     * @return Estudiantes
     */
    public function setPrograma($programa)
    {
        $this->programa = $programa;

        return $this;
    }

    /**
     * Get programa
     *
     * @return string 
     */
    public function getPrograma()
    {
        return $this->programa;
    }

    /**
     * Set tesis
     *
     * @param string $tesis
     * @return Estudiantes
     */
    public function setTesis($tesis)
    {
        $this->tesis = $tesis;

        return $this;
    }

    /**
     * Get tesis
     *
     * @return string 
     */
    public function getTesis()
    {
        return $this->tesis;
    }

    /**
     * Set alumno
     *
     * @param string $alumno
     * @return Estudiantes
     */
    public function setAlumno($alumno)
    {
        $this->alumno = $alumno;

        return $this;
    }

    /**
     * Get alumno
     *
     * @return string 
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    /**
     * Set academico
     *
     * @param \InformeBundle\Entity\Academico $academico
     * @return Estudiantes
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
}
