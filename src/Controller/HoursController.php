<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    
    /**
     * @route("/hours/range", name="range", methods={"GET"})
     */
    public function getHoursRange(Request $request){
        
        // sekcja zwraca rok w którym został zarejestrowany pierwszy i ostatni rekord
        
        $first = $this->hoursRep->getFirstRegisteredDate();
        $last = $this->hoursRep->getLastRegisteredDate();
        
        $first = isset($first[0]['date']) ? $first[0]['date'] : null;
        $last = isset($last[0]['date']) ? $last[0]['date'] : null;
       
        if (is_null($first) || is_null($last)) return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        
        $date=[];
        $date['first']=date_format($first, 'Y');
        $date['last']=date_format($last, 'Y');
                
        $response = new JsonResponse($date);
        
        return $response; 
    }
    
    /**
     * @route("/hours/monthly_report/{id}", name="hours_monthly_report", methods={"GET"})
     */
    public function getHoursForMonthlyReport(Request $request, $id){
        
        // pobiera dane do raportu miesięcznego
        
        $datefrom=$request->query->get('datefrom');
        $dateto=$request->query->get('dateto');
        $type=1;
        $resp=[];
        
        $hours = $this->hoursRep->getHoursForMonthlyReport($id, $datefrom, $dateto, $type);
        
        foreach($hours as $key => $value) {
            $day = date_format($value['date'], 'Y-m-d');
            $resp[$day]['summary'] = $value['summary'];
        }
        
        $response = new JsonResponse($resp);
        
        return $response;
    }
    
    /**
     * @route("/hours/project_report", name="hours_project_report", methods={"GET"})
     */
    public function getHoursForProjectReport(Request $request, TasksRepository $tasksRep){
        
        // pobiera dane do raportu projekt - raport prezentuje procentowy udział w projekcie według typu zadań
        
        $datefrom=$request->query->get('datefrom');
        $dateto=$request->query->get('dateto');
        $projectId=$request->query->get('projectId');
        
        $hours = $this->hoursRep->getHoursForProjectReport($datefrom, $dateto, $projectId);
        $projectSum = $this->hoursRep->getSummaryHoursForProjectReport($datefrom, $dateto, $projectId);
        $projectSum = $projectSum[0]['summary'];
        
        foreach($hours as $key => $value) {
            
            $taskId = $hours[$key]['task_id'];
            $type=$tasksRep->findOneBy(array('id' => $taskId))->getType()->getDescription();
            $hours[$key]['description']=$type;
            $percent=($hours[$key]['summary']/$projectSum)*100;
            $hours[$key]['percent']=number_format($percent,2);
          
        }     
        
        $response = new JsonResponse($hours);
        
        return $response;
    }
}
