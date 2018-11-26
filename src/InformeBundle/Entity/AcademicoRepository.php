<?php

namespace InformeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Academico Repository
 *
 *
 */
class AcademicoRepository extends EntityRepository
{

    /**
     * Change default sort order for entities
     * Sorted by name ascending.
     *
     * @return array of entities:
     */
    public function findAll()
    {
        return $this->findBy(array(), array('apellido' => 'ASC'));
    }


}
