<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestApiController extends AbstractController
{
    /**
     * @Route("/api/test", name="testapi")
     */
    public function index()
    {
        $response = new JsonResponse(array('loginOK' => 0));
        return $response;
    }
}
