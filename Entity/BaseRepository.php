<?php

namespace ITDoors\CommonBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * BaseRepository
 *
 * This class do common query things
 */
class BaseRepository extends EntityRepository
{
    /**
     * Generates query than get all fields from db
     *
     * @param mixed[] $options
     *
     * @return Query
     */
    public function getDBQuery($options)
    {
        if (!isset($options['id'])) {
            return null;
        }

        $sql = $this->createQueryBuilder('base')
            ->where('base.id = :id')
            ->setParameter(':id', $options['id']);

        return $sql->getQuery();
    }
}
