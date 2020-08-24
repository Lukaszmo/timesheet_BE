<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\ProjectTaskRel;
use App\Entity\Tasks;

class TaskController extends AbstractController{
    
    /**
     * @route("/project_tasks/{projectId}", name="tasks")
     */
    public function getTasks(Request $request, $projectId){
        
        //Zwraca listę zadań przypisanych do projektu
        
        $taskList = $this->getDoctrine()->getRepository(ProjectTaskRel::class)->findBy(array('project' => $projectId));
        
        $list = null;
        
        foreach($taskList as $key => $value) {
            
            $taskId = $value->getTask()->getId();
            $task = $this->getDoctrine()->getRepository(Tasks::class)->findOneBy(array('id' => $taskId));
            $list[$key]['id'] = $taskId;
            $list[$key]['code'] = $task->getCode();
            $list[$key]['description'] = $task->getDescription();
        } 
        
        $response = new JsonResponse($list);
        
        return $response;     
    }
}
