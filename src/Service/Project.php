<?php

namespace App\Service;

use App\Repository\ProjectUserRelRepository;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\ProjectTaskRel;
use App\Entity\Projects;
use App\Entity\Tasks;


class Project {
    
    private $projectUserRep;
    
    private $em;
    
    public function __construct(ProjectUserRelRepository $rep, EntityManagerInterface $em){
        
        $this->projectUserRep = $rep;
        $this->em = $em;
    }
    
    public function getProjects(int $id): ? array {
        
       //Zwraca listę aktywnych projektów przypisanych do użytkownika
       
       $projectList = $this->projectUserRep->findBy(array('user' => $id, 'active' => true));
        
       $list = Array();
       $idx=0;
        
       foreach($projectList as $value) {
            
            if (!$value->getProject()->getActive()) continue;
            
            $list[$idx]['id'] = $value->getProject()->getId();
            $list[$idx]['code'] = $value->getProject()->getCode();
            $list[$idx]['description'] = $value->getProject()->getDescription();
            $idx++;
       }
        
       if (!is_null($list)){
            usort($list, function($a,$b) {
                return strtoupper($a['description']) <=> strtoupper($b['description']);
            });
        } 
        
        return $list;
    }
    
    public function addTaskToProject(array $ProjectTaskArray){
        
        $this->em->beginTransaction();
        
        try{
            
            foreach ($ProjectTaskArray as $value) {
                
                $projectTask = new ProjectTaskRel();
                $project = $this->em->getRepository(Projects::class)->findOneBy(array('id' => $value['project']));
                $task = $this->em->getRepository(Tasks::class)->findOneBy(array('id' => $value['task']));
                $projectTask->setProject($project);
                $projectTask->setTask($task);
                $projectTask->setActive(true);
                $this->em->persist($projectTask);
                $this->em->flush();
            }
        
            $this->em->commit(); 
            
        } catch (\Exception $e) {
            
            $this->em->rollBack();
            throw $e;
        }
    }
}