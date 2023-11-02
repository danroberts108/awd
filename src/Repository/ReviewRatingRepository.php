<?php

namespace App\Repository;

use App\Entity\ReviewRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReviewRating>
 *
 * @method ReviewRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReviewRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReviewRating[]    findAll()
 * @method ReviewRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReviewRating::class);
    }

//    /**
//     * @return ReviewRating[] Returns an array of ReviewRating objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ReviewRating
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
