<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Form\EditAddentrepriseType;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AddEntrepriseType;
use entreprise as GlobalEntreprise;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    #[Route('/entreprise', name: 'app_entreprise')]
    public function index(EntrepriseRepository $entrepriseRepository): Response
    {
        $entrepriseBD= $entrepriseRepository->findAll();
       
         return $this->render('entreprise/index.html.twig', [
             'controller_name' => '$EntrepriseController',
             "entreprises" => $entrepriseBD
         ]);
    }
    #[Route('/entreprise/new/{id}', name: 'app_entreprise_neew')]
    public function new(EntityManagerInterface $em, EntrepriseRepository $ar ,$id)
    {
       $entreprise=$ar->find($id);
       $entreprise->setName("picture");
       $entreprise->setAddress("testt");
    
       $em->persist($entreprise);
       $em->flush();
       dd($entreprise);
    }

    #[Route('/entreprise/delete/{id}', name: 'app_entreprise_delete')]
    public function delete(EntityManagerInterface $em, EntrepriseRepository $ar ,$id)
    {
       $entreprise=$ar->find($id);
       $em->remove($entreprise);
       $em->flush();
       dd($entreprise);
    }

    #[Route('/entreprise/edit/{id}', name: 'app_entreprise_neew')]
    public function edit($id,EntityManagerInterface $em)
    {
       $entreprise=new Entreprise();
       $entreprise->setName("picture");
       $entreprise->setAddress("testt");
       $em->persist($entreprise);
       $em->flush();
       dd($entreprise);
    }

    #[Route('/entreprise/form', name: 'app_entreprise_form')]
    public function form(Request $request,EntityManagerInterface $em, EntrepriseRepository $ar)
    {

    $entreprise = new Entreprise();
      $form = $this->createForm(EditAddentrepriseType::class,$entreprise);
      $form->handleRequest($request);
      if($form->isSubmitted()){
        $em->persist($entreprise);
        $em->flush();
        return $this->redirectToRoute('app_entreprise');
        
      }
      return $this->renderForm('entreprise/form.html.twig',['form'=>$form,'info'=>'Add Entreprise']);
    }
 
    }
