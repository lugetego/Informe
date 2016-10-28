<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eventos
 *
 * @ORM\Table(name="eventos", indexes={@ORM\Index(name="IDX_6B23BD8F47F88255", columns={"academico_id"})})
 * @ORM\Entity
 */
class Eventos
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="organizador", type="boolean", nullable=false)
     */
    private $organizador;

    /**
     * @var boolean
     *
     * @ORM\Column(name="nacional", type="boolean", nullable=false)
     */
    private $nacional;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=255, nullable=false)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="institucion", type="string", length=255, nullable=false)
     */
    private $institucion;

    /**
     * @var string
     *
     * @ORM\Column(name="platica", type="string", length=255, nullable=false)
     */
    private $platica;

    /**
     * @var string
     *
     * @ORM\Column(name="actividad", type="string", length=255, nullable=false)
     */
    private $actividad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="informacion", type="string", length=255, nullable=false)
     */
    private $informacion;

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
