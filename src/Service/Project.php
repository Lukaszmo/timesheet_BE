<?php

namespace App\Service;

use App\Repository\ProjectUserRelRepository;


class Project {
    
    private $projectUserRep;
    
    public function __construct(ProjectUserRelRepository $rep){
        
        $this->projectUserRep = $rep;
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
}