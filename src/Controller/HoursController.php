<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Repository\HoursRepository;
use App\Repository\HourTypesRepository;
use App\Repository\ProjectsRepository;
use App\Repository\TasksRepository;


class HoursController extends AbstractController
{
    public function __construct(HoursRepository $hoursRep)
    {
        $this->hoursRep=$hoursRep;
    }
    
    /**
     * @Route("/hours/by_type/{id}", name="hours_by_type", methods={"GET"})
     */
    public function getHoursByType(Request $request, $id, HourTypesRepository $typesRep)
    {
        // zwraca sumaryczną liczbę godzin pogrupowaną według typów
        
        $datefrom=$request->query->get('dateFrom');
        $dateto=$request->query->get('dateTo');
        $hours = $this->hoursRep->getHoursByType($id,$datefrom,$dateto);
        
        foreach($hours as $key => $value) {
            
            $recId = $hours[$key]['type_id'];
            $hours[$key]['description'] = $typesRep->findOneBy(array('id' => $recId))->getDescription();
        }
      
        $response = new JsonResponse($hours);
        
        return $response;
    }
    
    /**
     * @Route("/hours/by_project/{id}", name="hours_by_project", methods={"GET"})
     */
    public function getHoursByProject(Request $request, $id, ProjectsRepository $projectsRep)
    {
        // zwraca sumaryczną liczbę godzin pogrupowaną według projektów
        
        $datefrom=$request->query->get('dateFrom');
        $dateto=$request->query->get('dateTo');
        $hours = $this->hoursRep->getHoursByProject($id,$datefrom,$dateto);
        
        foreach($hours as $key => $value) {
            
            $recId = $hours[$key]['project_id'];
            $hours[$key]['description'] = $projectsRep->findOneBy(array('id' => $recId))->getDescription();
        }
        
        $response = new JsonResponse($hours);
        
        return $response;
    }
    
    /**
     * @Route("/hours/by_task/{id}", name="hours_by_task", methods={"GET"})
     */
    public function getHoursByTask(Request $request, $id, TasksRepository $tasksRep)
    {
        // zwraca sumaryczną liczbę godzin pogrupowaną według zadań
        
        $datefrom=$request->query->get('dateFrom');
        $dateto=$request->query->get('dateTo');
        $hours = $this->hoursRep->getHoursByTask($id,$datefrom,$dateto);
        
        foreach($hours as $key => $value) {
            
            $recId = $hours[$key]['task_id'];
            $hours[$key]['description'] = $tasksRep->findOneBy(array('id' => $recId))->getDescription();
        }
        
        $response = new JsonResponse($hours);
        
        return $response;
    }
}
