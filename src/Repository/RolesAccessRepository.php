<?php

namespace App\Repository;

use App\Entity\RolesAccess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RolesAccess|null find($id, $lockMode = null, $lockVersion = null)
 * @method RolesAccess|null findOneBy(array $criteria, array $orderBy = null)
 * @method RolesAccess[]    findAll()
 * @method RolesAccess[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RolesAccessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RolesAccess::class);
    }

    // /**
    //  * @return RolesAccess[] Returns an array of RolesAccess objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RolesAccess
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
