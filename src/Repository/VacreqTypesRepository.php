<?php

namespace App\Repository;

use App\Entity\VacreqTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VacreqTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method VacreqTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method VacreqTypes[]    findAll()
 * @method VacreqTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacreqTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VacreqTypes::class);
    }

    // /**
    //  * @return VacreqTypes[] Returns an array of VacreqTypes objects
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
    public function findOneBySomeField($value): ?VacreqTypes
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
