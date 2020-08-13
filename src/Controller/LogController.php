<?php

namespace App\Controller;

use App\Entity\Log;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Route("/log")
 */

class LogController extends AbstractController
{
    
    
    
    /**
     * @Route("/get/{id}", name="get", methods={"GET"})
     */
    public function getById(Log $id){
        
        return $this->json($this->getDoctrine()->getRepository(Log::class)->find($id));
    }
    
    /**
     * @Route("/add", name="add", methods={"POST"})
     */
    public function add(Request $request)
    {
        /** @var Serializer $serializer */
        $serializer = $this->get('serializer');
        $log = $serializer->deserialize($request->getContent(), Log::class, 'json');
        $em = $this->getDoctrine()->getManager();
        $em->persist($log);
        $em->flush();
        return $this->json($log);
    }
    
    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Log $id) {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        
    }
    
    
}
