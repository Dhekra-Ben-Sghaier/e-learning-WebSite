<?php

namespace App\Repository;

use App\Entity\Recformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recformation[]    findAll()
 * @method Recformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recformation::class);
    }

    // /**
    //  * @return Recformation[] Returns an array of Recformation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recformation
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
