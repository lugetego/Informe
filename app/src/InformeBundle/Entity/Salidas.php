<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salidas
 *
 * @ORM\Table(name="salidas", indexes={@ORM\Index(name="IDX_639CF26E47F88255", columns={"academico_id"})})
 * @ORM\Entity
 */
class Salidas
{
    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=255, nullable=false)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=255, nullable=false)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="universidad", type="string", length=255, nullable=false)
     */
    private $universidad;

    /**
     * @var string
     *
     * @ORM\Column(name="profesor", type="string", length=255, nullable=false)
     */
    private $profesor;

    /**
     * @var string
     *
     * @ORM\Column(name="actividad", type="string", length=255, nullable=false)
     */
    private $actividad;

    /**
     * @var string
     *
     * @ORM\Column(name="proposito", type="string", length=255, nullable=false)
     */
    private $proposito;

    /**
     * @var string
     *
     * @ORM\Column(name="proyecto", type="string", length=255, nullable=false)
     */
    private $proyecto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="date", nullable=false)
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="date", nullable=false)
     */
    private $fin;

    /**
     * @var string
     *
     * @ORM\Column(name="trabajo", type="string", length=255, nullable=false)
     */
    private $trabajo;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=false)
     */
    private $observaciones;

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
