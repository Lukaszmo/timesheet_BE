<?php

namespace App\Repository;

use App\Entity\HourTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HourTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method HourTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method HourTypes[]    findAll()
 * @method HourTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HourTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HourTypes::class);
    }

    // /**
    //  * @return HourTypes[] Returns an array of HourTypes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HourTypes
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
