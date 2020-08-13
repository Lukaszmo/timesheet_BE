<?php

namespace App\Repository;

use App\Entity\VacreqStates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VacreqStates|null find($id, $lockMode = null, $lockVersion = null)
 * @method VacreqStates|null findOneBy(array $criteria, array $orderBy = null)
 * @method VacreqStates[]    findAll()
 * @method VacreqStates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacreqStatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VacreqStates::class);
    }

    // /**
    //  * @return VacreqStates[] Returns an array of VacreqStates objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VacreqStates
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
