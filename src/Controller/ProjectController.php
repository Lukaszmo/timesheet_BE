<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\ProjectUserRel;



class ProjectController extends AbstractController{
    
    /**
     * @route("/user_projects/{id}", name="user_projects", methods={"GET"})
     */
    public function getProjects(Request $request, $id){
        
        //Zwraca listę aktywnych projektów przypisanych do użytkownika
        
        $projectList = $this->getDoctrine()->getRepository(ProjectUserRel::class)->findBy(array('user' => $id));
        
        $list = null;
        $idx=0;
       
        foreach($projectList as $value) {
            
            if (!$value->getProject()->getActive()) continue;
            
            $list[$idx]['id'] = $value->getProject()->getId();
            $list[$idx]['code'] = $value->getProject()->getCode();
            $list[$idx]['description'] = $value->getProject()->getDescription();
            $idx++;
        }
        
        $response = new JsonResponse($list);
        
        return $response;
        
    } 
}