<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\AddEmployeType;
use App\Entity\Employe;
use App\Form\EdditAddEmployeType;
use App\Repository\EmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeController extends AbstractController
{
    #[Route('/employe', name: 'app_employe')]
   
    public function index(EmployeRepository $employeRepository): Response
    {
        $employesBD= $employeRepository->findAll();
       
        return $this->render('employe/index.html.twig', [
            'controller_name' => '$AuthorController',
            "employes" => $employesBD
        ]);
    }
    #[Route('/employe/new', name: 'app_entreprise_new')]
    public function new(EntityManagerInterface $em, EmployeRepository $ar ,$id)
    {
       $employe=$ar->find($id);
       $employe->setFirstname();
       $employe->setLastname("testt");
       $employe->setBirthday(Date(""));
       $employe->setEntreprise();
       $em->persist($employe);
       $em->flush();
       dd($employe);
    }
    #[Route('/employe/delete/{id}', name: 'app_author_delete')]
    public function delete(EntityManagerInterface $em, EmployeRepository $ar ,$id)
    {
       $author=$ar->find($id);
       $em->remove($employe);
       $em->flush();
       dd($employe);
    }
    #[Route('/employe/form', name: 'app_employe_form')]
    public function form(Request $request,EntityManagerInterface $em, EmployeRepository $ar)
    {

        $employe = new Employe();
      $form = $this->createForm(EdditAddEmployeType::class,$employe);
      $form->handleRequest($request);
      if($form->isSubmitted()){
        $em->persist($employe);
        $em->flush();
        return $this->redirectToRoute('app_employe');
        
      }
return $this->renderForm('employe/form.html.twig', ['form'=>$form]);

    }
    #[Route('/employe/edit/{id}', name: 'app_employe_neew')]
    public function edit($id,EntityManagerInterface $em)
    {
       $employe=new Employe();
       $employe->setFirstname()("kossay");
       $employe->setLastname("boubaker");
       $employe->setBirthday(18/06/200);
       $employe->setEntreprise(true);
       $em->persist($employe);
       $em->flush();
       dd($employe);
    }

}
