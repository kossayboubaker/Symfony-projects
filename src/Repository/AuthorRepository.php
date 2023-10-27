<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 *
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    
    // @return Author[] Returns an array of Author objects
    
    public function findA11Authors ($username,$email)

{

    return $this->createQueryBuilder('a')
    
    
    ->where("a.username LIKE username")
    
    
    ->andwhere("a.email LIKE :email")
        
    ->setParameter('username', '%'.$username, '%')
    
    ->setParameter('email', 'X'.$email. 'X')
    
    ->orderBy('a.id', 'ASC')
    
    ->getQuery()
    
    ->getResult()
    
;
//    public function findOneBySomeField($value): ?Author
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
}