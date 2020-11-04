<?php

namespace App\Repository;

use App\Entity\TaskTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TaskTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskTypes[]    findAll()
 * @method TaskTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskTypes::class);
    }

    // /**
    //  * @return TaskTypes[] Returns an array of TaskTypes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TaskTypes
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
