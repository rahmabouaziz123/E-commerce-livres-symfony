<?php

namespace App\Controller;



use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\BookRepository;


class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $resposotory = $doctrine->getRepository(Book::class);
        $book1 = $resposotory->findAll();

        //return $this->render('article/index.html.twig', ['articles' => $articles1]);

        // return $this->render('book/index.html.twig', ['controller_name' => 'BookController',]);
        return $this->render('book/index.html.twig', ['Books' => $book1]);

    }

    // detail de book

    #[Route('/book/{id}', name: 'book-affiche')]
    public function affiche(ManagerRegistry $doctrine, $id): Response
    {
        $repository = $doctrine->getRepository(Book::class);
        $book = $repository->find($id);

        return $this->render('book/affiche.html.twig', ['livre' => $book]);
    }


    //////////////////////////////////////////////////////////////
    //3. Pour récupérer également la liste des livres ayant un prix inférieur à 150d
     
  
    #[Route('/livres-prix-inferieur', name: 'livres_prix_inferieur')]
    public function livresPrixInferieur(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Book::class);
        $queryBuilder = $repository->createQueryBuilder('b');

        $queryBuilder
            ->andWhere('b.prix < :prix')
            ->setParameter('prix', 150)
            ->orderBy('b.id', 'ASC');

        $Manylivres = $queryBuilder->getQuery()->getResult();

        return $this->render('book/listPrix.html.twig', ['leslivres' => $Manylivres]);
    }



    ////////////////////////////////////////////////////////////////////
    #[Route('/search', name: 'search_books')]
    public function searchBooks(Request $request, BookRepository $bookRepository): Response
    {
        $searchTerm = $request->query->get('searchTerm');
        $books = $bookRepository->findBySearchTerm($searchTerm);

        return $this->render('book/search.html.twig', [
            'books' => $books,
            'searchTerm' => $searchTerm, // Ajout de searchTerm pour l'afficher dans le template Twig
        ]);
    }







}
