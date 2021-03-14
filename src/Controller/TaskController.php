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
     * @route("/project_tasks/{projectId}", name="project_tasks", methods={"GET"})
     */
    public function getTasks(Request $request, $projectId){
        
        //Zwraca listę zadań przypisanych do projektu
        
        $taskList = $this->getDoctrine()->getRepository(ProjectTaskRel::class)->findBy(array('project' => $projectId,'active' => true));
        
        $list = null;
        $idx=0;
        
        foreach($taskList as $value) {
            
            if (!$value->getTask()->getActive()) continue;
            
            $taskId = $value->getTask()->getId();
            $task = $this->getDoctrine()->getRepository(Tasks::class)->findOneBy(array('id' => $taskId));
            $list[$idx]['id'] = $taskId;
            $list[$idx]['code'] = $task->getCode();
            $list[$idx]['description'] = $task->getDescription();
            $idx++;
        } 
        
        $response = new JsonResponse($list);
        
        return $response;     
    }
}
