<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    #[Route('/student/{name}', name: 'app_student2')]
    public function index2($name): Response
    {
        return $this->render('student/index2.html.twig', [
            'controller_name' => 'StudentController',
            'name'=>$name
        ]);
    }
}
