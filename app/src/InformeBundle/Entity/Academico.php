<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Academico
 *
 * @ORM\Table(name="academico", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_1944FEDA76ED395", columns={"user_id"})}, indexes={@ORM\Index(name="autor_id", columns={"autor_id"})})
 * @ORM\Entity
 */
class Academico
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=120, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=120, nullable=false)
     */
    private $apellido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nacimiento", type="date", nullable=false)
     */
    private $nacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="rfc", type="string", length=10, nullable=false)
     */
    private $rfc;

    /**
     * @var integer
     *
     * @ORM\Column(name="autor_id", type="integer", nullable=false)
     */
    private $autorId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \InformeBundle\Entity\FosUser
     *
     * @ORM\ManyToOne(targetEntity="InformeBundle\Entity\FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}
