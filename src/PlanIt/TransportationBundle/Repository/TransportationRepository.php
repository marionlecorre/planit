<?php

namespace PlanIt\TransportationBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TransportationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TransportationRepository extends EntityRepository
{
	public function findByModule($module_id){
        return $this->createQueryBuilder('t')
                    ->leftjoin('t.module', 'm')
                    ->where('m.id = :module_id')
                    ->setParameter('module_id', $module_id)
                    ->getQuery()
                    ->getResult();
	}
}
