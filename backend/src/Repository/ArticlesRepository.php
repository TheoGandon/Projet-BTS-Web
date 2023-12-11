<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Articles>
 *
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    public function getArticlePictures($article_id): array
    {
        return $this->createQueryBuilder('a')
            ->setParameter('articleId', $article_id)
            ->select('articlePicture.picture_link')
            ->distinct(true)
            ->from('App\Entity\articlePicture', 'articlePicture')
            ->join('articlePicture.article_id', 'article')
            ->where('article.id= :articleId')

            ->getQuery()
            ->getResult()
            ;
    }

    public function getArticleColors($article_id): array
    {
        return $this->createQueryBuilder('a')
            ->setParameter('articleId', $article_id)
            ->select('color.id')
            ->distinct(true)
            ->from('App\Entity\Color', 'color')
            ->join('color.articlePictures', 'article_picture')
            ->join('article_picture.article_id', 'article')
            ->where('article.id= :articleId')

            ->getQuery()
            ->getResult()
            ;
    }

//    /**
//     * @return Articles[] Returns an array of Articles objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Articles
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
