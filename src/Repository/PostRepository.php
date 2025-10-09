<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Select;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    //    /**
    //     * @return Post[] Returns an array of Post objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Post
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function findByCategory($category):array
    {
        return $this->createQueryBuilder('p')
                    //->select(
                    //        "p.title",
                    //            "p.content",
                    //            "p.createdAt",
                    //            "p.image",
                    //            "p.slug",
                    //            "c.name"
                    //        )
                    ->leftJoin('p.category', 'c')
                    ->where('c.slug = :val')
                    ->andWhere('p.isPublished = 1')
                    ->setParameter('val', $category)
                    ->orderBy('p.createdAt', 'DESC')
                    ->getQuery()
                    ->getResult();
    }
}
