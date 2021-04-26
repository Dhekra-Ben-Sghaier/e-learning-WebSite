<?php

namespace App\Repository;

use App\Entity\PostulerStage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostulerStage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostulerStage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostulerStage[]    findAll()
 * @method PostulerStage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostulerStageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostulerStage::class);
    }


    // /**
    //  * @return PostulerStage[] Returns an array of PostulerStage objects
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
    public function findOneBySomeField($value): ?PostulerStage
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
