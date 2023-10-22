<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Author;
use App\Form\AddAuthorType;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Node\Expression\Binary\AddBinary;

class AuthorController extends AbstractController
{
    #[Route('/author/new/{id}', name: 'app_author_neew')]
    public function new(EntityManagerInterface $em, AuthorRepository $ar ,$id)
    {
       $author=$ar->find($id);
       $author->setPicture("picture");
       $author->setUsername("testt");
       $author->setEmail("EMAIL.com");
       $author->setNbBooks(200);
       $em->persist($author);
       $em->flush();
       dd($author);
    }

    #[Route('/author/delete/{id}', name: 'app_author_delete')]
    public function delete(EntityManagerInterface $em, AuthorRepository $ar ,$id)
    {
       $author=$ar->find($id);
       $em->remove($author);
       $em->flush();
       dd($author);
    }

    #[Route('/author/edit/{id}', name: 'app_author_neew')]
    public function edit($id,EntityManagerInterface $em)
    {
       $author=new Author();
       $author->setPicture("picture");
       $author->setUsername("testt");
       $author->setEmail("EMAIL");
       $author->setNbBooks(200);
       $em->persist($author);
       $em->flush();
       dd($author);
    }

    #[Route('/author/form', name: 'app_author_form')]
    public function form(Request $request,EntityManagerInterface $em, AuthorRepository $ar)
    {

        $author = new Author();
      $form = $this->createForm(AddAuthorType::class,$author);
      $form->handleRequest($request);
      if($form->isSubmitted()){
        $em->persist($author);
        $em->flush();
        return $this->redirectToRoute('app_author');
        
      }
      return $this->renderForm('author/new.html.twig',['form'=>$form,'info'=>'Add Author']);
    }
    #[Route('/author', name: 'app_author')]
    public function index(AuthorRepository $authorRepository): Response
    {
        $authorsBD= $authorRepository->findAll();
       $authors = array(
            array('id' => 1, 'picture' => '/images/victor-Hugo.jpg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
            );
        return $this->render('author/index.html.twig', [
            'controller_name' => '$AuthorController',
            "authors" => $authorsBD
        ]);
    }
    
}
