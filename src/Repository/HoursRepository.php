<?php

namespace App\Repository;

use App\Entity\Hours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Hours|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hours|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hours[]    findAll()
 * @method Hours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hours::class);
    }

    // /**
    //  * @return Hours[] Returns an array of Hours objects
    //  */
    
    public function getHoursByType($userid,$datefrom,$dateto)
    {
        
        return $this->createQueryBuilder('h')
        ->select('SUM(h.quantity) as summary','IDENTITY(h.type) as type_id')
        ->andWhere('h.userid = :val')
        ->setParameter('val', $userid)
        ->andWhere('h.date >= :datefrom')
        ->setParameter('datefrom', $datefrom)
        ->andWhere('h.date <= :dateto')
        ->setParameter('dateto', $dateto)
        ->groupBy('h.type')
        ->getQuery()
        ->getResult()
        ;   
    }
    

    public function getHoursByProject($userid,$datefrom,$dateto)
    {
        
        return $this->createQueryBuilder('h')
        ->select('SUM(h.quantity) as summary','IDENTITY(h.project) as project_id')
        ->andWhere('h.userid = :val')
        ->setParameter('val', $userid)
        ->andWhere('h.date >= :datefrom')
        ->setParameter('datefrom', $datefrom)
        ->andWhere('h.date <= :dateto')
        ->setParameter('dateto', $dateto)
        ->groupBy('h.project')
        ->getQuery()
        ->getResult()
        ;   
    }
    
    public function getHoursByTask($userid,$datefrom,$dateto)
    {
        
        return $this->createQueryBuilder('h')
        ->select('SUM(h.quantity) as summary','IDENTITY(h.task) as task_id')
        ->andWhere('h.userid = :val')
        ->setParameter('val', $userid)
        ->andWhere('h.date >= :datefrom')
        ->setParameter('datefrom', $datefrom)
        ->andWhere('h.date <= :dateto')
        ->setParameter('dateto', $dateto)
        ->groupBy('h.task')
        ->getQuery()
        ->getResult()
        ;
    }
    
    public function getHoursForMonthlyReport($userid,$datefrom,$dateto,$type)
    {
        
        return $this->createQueryBuilder('h')
        ->select('h.date','SUM(h.quantity) as summary')
        ->andWhere('h.userid = :userid')
        ->setParameter('userid', $userid)
        ->andWhere('h.date >= :datefrom')
        ->setParameter('datefrom', $datefrom)
        ->andWhere('h.date <= :dateto')
        ->setParameter('dateto', $dateto)
        ->andWhere('h.type = :type')
        ->setParameter('type', $type)
        ->groupBy('h.date')
        ->getQuery()
        ->getResult()
        ;
    }
    
    public function getFirstRegisteredDate()
    {
        
        return $this->createQueryBuilder('h')
        ->select('h.date')
        ->orderBy('h.date')
        ->setMaxResults(1)
        ->getQuery()
        ->getResult()
        ;
    }
    
    public function getLastRegisteredDate()
    {
        
        return $this->createQueryBuilder('h')
        ->select('h.date')
        ->orderBy('h.date','DESC')
        ->setMaxResults(1)
        ->getQuery()
        ->getResult()
        ;
    }
    
    public function getHoursForProjectReport($datefrom,$dateto,$projectId)
    {
        
        return $this->createQueryBuilder('h')
        ->select('SUM(h.quantity) as summary','IDENTITY(h.task) as task_id')
        ->andWhere('h.project = :projectId')
        ->setParameter('projectId', $projectId)
        ->andWhere('h.date >= :datefrom')
        ->setParameter('datefrom', $datefrom)
        ->andWhere('h.date <= :dateto')
        ->setParameter('dateto', $dateto)
        ->groupBy('h.task')
        ->getQuery()
        ->getResult()
        ;
    }
    
    public function getSummaryHoursForProjectReport($datefrom,$dateto,$projectId)
    {
        
        return $this->createQueryBuilder('h')
        ->select('SUM(h.quantity) as summary')
        ->andWhere('h.project = :projectId')
        ->setParameter('projectId', $projectId)
        ->andWhere('h.date >= :datefrom')
        ->setParameter('datefrom', $datefrom)
        ->andWhere('h.date <= :dateto')
        ->setParameter('dateto', $dateto)
        ->getQuery()
        ->getResult()
        ;
    }
}
