<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    // public function __construct(ManagerRegistry $registry)
    // {
    //     parent::__construct($registry, Book::class);
    // }





    //    /**
    //     * @return Book[] Returns an array of Book objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }



    // private $entityManager;

    // public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    // {
    //     parent::__construct($registry, Book::class);
    //     $this->entityManager = $entityManager;
    // }


    // public function findBySearchTerm($searchTerm)
    // {
    //     $queryBuilder = $this->entityManager->createQueryBuilder();

    //     // Utilisation des paramètres nommés pour éviter les problèmes de sécurité (liaison de paramètres)
    //     $queryBuilder
    //         ->select('b')
    //         ->from(Book::class, 'b')
    //         ->where($queryBuilder->expr()->like('b.titre', ':Dune'))
    //         ->orWhere($queryBuilder->expr()->like('b.auteur', ':Frank Herbert'))
    //         ->orWhere($queryBuilder->expr()->like('b.categorie', ':Science-fiction'))
    //         ->setParameter('searchTerm', '%'.$searchTerm.'%')
    //         ->orderBy('b.id', 'ASC');

    //     return $queryBuilder->getQuery()->getResult();
    // }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findBySearchTerm($searchTerm)
    {
        $queryBuilder = $this->createQueryBuilder('b');

        // Utilisation des paramètres nommés pour éviter les problèmes de sécurité (liaison de paramètres)
        $queryBuilder
            ->where($queryBuilder->expr()->like('b.titre', ':searchTerm'))
            ->orWhere($queryBuilder->expr()->like('b.auteur', ':searchTerm'))
            ->orWhere($queryBuilder->expr()->like('b.catégorie', ':searchTerm'))
          
            ->setParameter('searchTerm', '%'.$searchTerm.'%')
            ->orderBy('b.id', 'ASC');

        return $queryBuilder->getQuery()->getResult();
    }

}
