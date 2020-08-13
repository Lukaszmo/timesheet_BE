<?php


namespace App\EventSubscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordHashSubscriber implements EventSubscriberInterface 
{
    
    public function  __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder=$passwordEncoder;
        
    }
    
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['HashPassword', EventPriorities::PRE_WRITE]
        ];
    }
    
    public function hashPassword(GetResponseForControllerResultEvent $event)
    {
        $user = $event->getControllerResult(); 
        $method = $event->getRequest()->getMethod();
        
        if (!$user instanceof User || Request::METHOD_POST !== $method){
            return;
        }
        
        //hashujemy hasło
        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, $user->getPassword())
            );
        
    }

    
    
    
    
}

