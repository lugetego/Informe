<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cursos
 *
 * @ORM\Table(name="cursos", indexes={@ORM\Index(name="IDX_B2785A1847F88255", columns={"academico_id"})})
 * @ORM\Entity
 */
class Cursos
{
    /**
     * @var string
     *
     * @ORM\Column(name="informacion", type="string", length=255, nullable=false)
     */
    private $informacion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

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
