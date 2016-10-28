<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Investigacion
 *
 * @ORM\Table(name="investigacion", indexes={@ORM\Index(name="IDX_E6BE58047F88255", columns={"academico_id"}), @ORM\Index(name="autor_id", columns={"autor_id"})})
 * @ORM\Entity
 */
class Investigacion
{
    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=120, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="autores", type="string", length=255, nullable=false)
     */
    private $autores;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=255, nullable=false)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="pags", type="string", length=255, nullable=false)
     */
    private $pags;

    /**
     * @var string
     *
     * @ORM\Column(name="volumen", type="string", length=255, nullable=false)
     */
    private $volumen;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255, nullable=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="issn", type="string", length=255, nullable=false)
     */
    private $issn;

    /**
     * @var string
     *
     * @ORM\Column(name="proyectos", type="string", length=255, nullable=false)
     */
    private $proyectos;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indizado", type="boolean", nullable=true)
     */
    private $indizado;

    /**
     * @var string
     *
     * @ORM\Column(name="revista", type="string", length=255, nullable=false)
     */
    private $revista;

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

    /**
     * @var \InformeBundle\Entity\Academico
     *
     * @ORM\ManyToOne(targetEntity="InformeBundle\Entity\Academico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="autor_id", referencedColumnName="autor_id")
     * })
     */
    private $autor;


}
