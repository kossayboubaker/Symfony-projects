<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\AddBookType;
use App\Form\EditAddbookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }
    #[Route('/book/new', name: 'app_book_new')]
    public function new(EntityManagerInterface $em, BookRepository $ar ,$id)
    {
       $book=$ar->find($id);
       $book->setTitle();
       $book->setPublicationdate("testt");
       $book->setPublished("EMAIL.com");
       $book->setNbBooks(200);
       $em->persist($book);
       $em->flush();
       dd($book);
    }
    #[Route('/book/form', name: 'app_book_form')]
    public function form(Request $request,EntityManagerInterface $em, BookRepository $ar)
    {

        $book = new Book();
      $form = $this->createForm(EditAddbookType::class,$book);
      $form->handleRequest($request);
      if($form->isSubmitted()){
        $em->persist($book);
        $em->flush();
        return $this->redirectToRoute('app_book');
        
      }
return $this->renderForm('book/form.html.twig', ['form'=>$form]);

    }
}
