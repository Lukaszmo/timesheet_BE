<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


use App\Service\Project;



class ProjectController extends AbstractController{
    
    private $project;
    
    
    public function __construct(Project $project){
        
        $this->project = $project;
    }
    
    /**
     * @route("/user_projects/{id}", name="user_projects", methods={"GET"})
     */
    public function getProjects(Request $request, $id){
        
        $projectList = $this->project->getProjects($id);
        
        $response = new JsonResponse($projectList);
        
        return $response;
    }
    
    
    /**
     * @route("/project/task_add", name="project_task_add", methods={"POST"})
     */
    public function addTaskToProject(Request $request){
        
        $postData = Array();
        
        if($content = $request->getContent()){
            
            $postData = json_decode($content,true);
        }
        
        $this->project->addTaskToProject($postData);
        
        $response = new JsonResponse('Records created',201);
        
        
        return($response);    
    } 
}