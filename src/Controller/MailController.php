<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Repository\UserRepository;


class MailController extends AbstractController{
    
    public function __construct(\Swift_Mailer $mailer, UserRepository $userRep)
    {
        $this->mailer=$mailer;
        $this->userRep=$userRep;
    }
    
    /**
     * @route("vacation_requests/mail", name="vacation_requests_mail", methods={"POST"})
     */
    public function mail(Request $request)
    {
            // wysłanie wniosku urlopowego do przełożonego
        
            $postData = [];
            if($content = $request->getContent()){
            
                $postData = json_decode($content,true);
            }
        
            $user = $this->userRep->find($postData['user']);
            $employeeFirstname = $user->getFirstname();
            $employeeLastname = $user->getLastname();
            $managerId = $user->getManagerId();
            $manager = $this->userRep->find($managerId);
            $managerEmail = $manager->getEmail();
        
            $message = (new \Swift_Message('Nowy wniosek urlopowy'))
                ->setFrom('timesheetappl.test@gmail.com')
                ->setTo($managerEmail)
                ->setBody($this->renderView('send.html.twig',array(
                    'employeeFirstname' => $employeeFirstname,
                    'employeeLastname' => $employeeLastname,
                    'dateFrom'   => $postData['datefrom'],
                    'dateTo' => $postData['dateto'],
                    'comment' => $postData['comment']
                )),'text/html');
          
            $this->mailer->send($message);  
        
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        
    } 
}