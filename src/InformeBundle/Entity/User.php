<?php
// src/AppBundle/Entity/User.php

namespace InformeBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="InformeBundle\Entity\Academico", mappedBy="user")
     */
    private $academico;

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * @param InformeBundle\Entity\Academico $academico
     * @return User
     */
    public function setAcademico(InformeBundle\Entity\Academico $academico = null)
    {
        $this->academico = $academico;

        return $this;
    }

    /**
     * Get academico
     *
     * @return InformeBundle\Entity\Academico
     */
    public function getAcademico()
    {
        return $this->academico;
    }

}
