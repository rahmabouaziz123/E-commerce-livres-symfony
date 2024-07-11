<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TableController extends AbstractController
{
    #[Route('/table', name: 'table')]
    public function index(ManagerRegistry $doctrine, SerializerInterface $serializer): Response
    {
        $repository = $doctrine->getRepository(Book::class);
        $books = $repository->findAll();

        $formattedBooks = $serializer->normalize($books);
        // var_dump($formattedBooks);

        return $this->render('table/index.html.twig', [
            'books' => $formattedBooks,
        ]);
    }
}
