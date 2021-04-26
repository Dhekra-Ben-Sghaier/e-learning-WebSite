<?php

namespace App\Repository;

use App\Entity\PostulerTravail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostulerTravail|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostulerTravail|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostulerTravail[]    findAll()
 * @method PostulerTravail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostulerTravailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostulerTravail::class);
    }

    // /**
    //  * @return PostulerTravail[] Returns an array of PostulerTravail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostulerTravail
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
