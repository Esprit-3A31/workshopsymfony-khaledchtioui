<?php

namespace App\Controller;
use App\Repository\ClassroomRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Student;
use App\Form\StudentType;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    #[Route('/student', name: 'app_student')]
    public function liststudent(StudentRepository $rep)
    {
        $students =$rep->findAll() ;
        //return new Response("réservation!");
        return $this->render("student/student.html.twig",['tab_student'=>$students]);
    }
    #[Route('/addstudent', name: 'app_addstudent')]
    public function addStudent(Request $request,StudentRepository $repository)
    {
        $student= new Student();
        $form= $this->createForm(StudentType::class,$student);
        $form->handleRequest($request);
        if($form->isSubmitted()){
           #  $em = $doctrine->getManager();
           # $em->persist($student);
           # $em->flush();
            $repository->add($student,true);
            return  $this->redirectToRoute("app_addstudent");
        }

        return $this->renderForm("student/add.html.twig",
            array("formStudent"=>$form));

    }



    #[Route('/deletecla/{id}', name: 'deletecla')]
    public function deleteClassroom($id,ManagerRegistry $doctrine,ClassroomRepository $repository)
    {
        $classroom= $repository->find($id);
        $em= $doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute("addClassroomForm");
    }





}
