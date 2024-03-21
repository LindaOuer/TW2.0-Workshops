<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('student/list', name: 'student_list')]
    public function list(): Response
    {
        return $this->render('student/list.html.twig', [
            'list' => 'List of students',
        ]);
    }

    #[Route('student/add', name: 'app_student_add')]
    public function add(Request $req, ManagerRegistry $m)
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $m->getManager()->persist($student);
            $m->getManager()->flush();
        }

        return $this->render('student/add.html.twig', [
            'f' => $form->createView()
        ]);
    }
}
