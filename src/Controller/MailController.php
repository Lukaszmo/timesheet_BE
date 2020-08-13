<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\User;
use App\Entity\VacationRequest;


class MailController extends AbstractController{
    
    /**
     * @route("/mail", name="mail")
     */
    public function mail(Request $request, \Swift_Mailer $mailer)
    {
        
        if ($request->isMethod('POST')){
        
            $postData = [];
            if($content = $request->getContent()){
            
                $postData = json_decode($content,true);
            }
        
            $user = $this->getDoctrine()->getRepository(User::class)->find($postData['userid']);
            $employeeFirstname = $user->getFirstname();
            $employeeLastname = $user->getLastname();
            $managerId = $user->getManagerId();
            $manager = $this->getDoctrine()->getRepository(User::class)->find($managerId);
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
          
            $mailer->send($message);  
        
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        }
    } 
}