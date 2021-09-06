<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\User;


class PasswordController extends AbstractController{
    
    private $userPasswordEncoder;
    
    private $em;
    
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $em){
        
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->em = $em;
    }
    
    /**
     * @route("/user/{id}/password/change", name="password_change", methods={"PUT"})
     */
    public function passwordChange(Request $request, User $user){
   
        $requestData = [];
        if($content = $request->getContent()){
   
            $requestData = json_decode($content,true);
        }
   
        $oldPassword = $requestData['password'];
        $newPassword = $requestData['newpassword'];
        
        $isPasswordValid = $this->userPasswordEncoder->isPasswordValid($user, $oldPassword);
        
        if (!$isPasswordValid){
            return new JsonResponse(['error' => 'Niepoprawne hasło'], Response::HTTP_CONFLICT);
        }
   
        $user->setPassword($this->userPasswordEncoder->encodePassword($user,$newPassword));
        $user->setPasswordTimestamp(new \DateTime());
        $this->em->flush();
   
        $response = new JsonResponse(null, Response::HTTP_OK);
   
        return $response;
   } 
}
    
  