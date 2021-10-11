<?php

namespace App\Repository;

use App\Entity\AssignedTasks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AssignedTasks|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssignedTasks|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssignedTasks[]    findAll()
 * @method AssignedTasks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssignedTasksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssignedTasks::class);
    }

    // /**
    //  * @return AssignedTasks[] Returns an array of AssignedTasks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AssignedTasks
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
