<?php

namespace PlanIt\EventBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends EntityRepository
{
  public function findNotFinishedByUserid($user_id)
    {
        $qb = $this->createQueryBuilder('e')
                   ->select('e')
                   ->where('e.user = :user_id')
                   ->andWhere('e.beginDate >= :today')
                   ->addOrderBy('e.beginDate', 'ASC')
                   ->setParameter('user_id', $user_id)
                   ->setParameter('today', date('Y-m-j H:i:s'));
        //Ajouter vérificaiton pour afficher que les évenments à venir pas les terminés

        return $qb->getQuery()
                  ->getResult()
        ;
    }

    public function findFinishedByUserid($user_id)
    {
        $qb = $this->createQueryBuilder('e')
                   ->select('e')
                   ->where('e.user = :user_id')
                   ->andWhere('e.beginDate < :today')
                   ->addOrderBy('e.beginDate', 'ASC')
                   ->setParameter('user_id', $user_id)
                   ->setParameter('today', date('Y-m-j H:i:s'));
        //Ajouter vérificaiton pour afficher que les évenments à venir pas les terminés

        return $qb->getQuery()
                  ->getResult()
        ;
    }
}
