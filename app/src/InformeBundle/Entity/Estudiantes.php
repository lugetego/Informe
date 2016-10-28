<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estudiantes
 *
 * @ORM\Table(name="estudiantes", indexes={@ORM\Index(name="IDX_B3522F6147F88255", columns={"academico_id"})})
 * @ORM\Entity
 */
class Estudiantes
{
    /**
     * @var string
     *
     * @ORM\Column(name="tesis", type="string", length=255, nullable=false)
     */
    private $tesis;

    /**
     * @var string
     *
     * @ORM\Column(name="alumno", type="string", length=255, nullable=false)
     */
    private $alumno;

    /**
     * @var string
     *
     * @ORM\Column(name="programa", type="string", length=255, nullable=false)
     */
    private $programa;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \InformeBundle\Entity\Academico
     *
     * @ORM\ManyToOne(targetEntity="InformeBundle\Entity\Academico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="academico_id", referencedColumnName="id")
     * })
     */
    private $academico;


}
