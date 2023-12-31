<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function search(string $search) {
        $qb = $this->createQueryBuilder('p')
            ->where('p.name LIKE :search')
            ->setParameter('search', '%'.$search.'%');

        $query = $qb->getQuery();

        return $query->execute();
    }

    public function createMovieQueryBuilder(string $search = null) : QueryBuilder {
        $queryBuilder = $this->addMovieQueryBuilder();

        if ($search) {
            $queryBuilder->andWhere('movie.name LIKE :search')
                ->setParameter('search', $search);
        }

        return $queryBuilder;
    }

    public function addMovieQueryBuilder(QueryBuilder $queryBuilder = null) {
        $queryBuilder = $queryBuilder ?? $this->createQueryBuilder('movie');

        return $queryBuilder->orderBy('movie.name', 'ASC');
    }

//    /**
//     * @return Movie[] Returns an array of Movie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Movie
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
