<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;
use LaravelDoctrine\ORM\Pagination\Paginatable;

abstract class Repository extends EntityRepository
{
    use Paginatable;

    /**
     *
     * @param array $criteria
     * @return object
     */
    public function firstOrNew(array $criteria)
    {
        $entity = $this->findOneBy($criteria);

        if (null === $entity) {
            $class = $this->getClassName();

            $entity = new $class(...array_values($criteria));
        }

        return $entity;
    }

    /**
     *
     * @param array $criteria
     * @return object
     */
    public function firstOrCreate(array $criteria)
    {
        $entity = $this->findOneBy($criteria);

        if (null === $entity) {
            $class = $this->getClassName();

            $entity = new $class(...array_values($criteria));

            $this->_em->persist($entity);

            $this->_em->flush();
        }

        return $entity;
    }
}
