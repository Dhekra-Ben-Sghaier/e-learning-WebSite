<?php

namespace App\Repository;

use App\Entity\OffreTravail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OffreTravail|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffreTravail|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffreTravail[]    findAll()
 * @method OffreTravail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreTravailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreTravail::class);
    }

    public function GetOTById($id){
        return $this->createQueryBuilder('off')
            ->andWhere('off.idSociete = :i')
            ->setParameter('i', $id)
            ->getQuery()
            ->getResult();
    }
    public function FindOT($criteria){
        $now= new \DateTime('today');
        return $this->createQueryBuilder('off')
            ->andWhere('off.nivEtude = :n')
            ->setParameter('n', $criteria['nivEtude'])
            ->andWhere('off.certificat = :c')
            ->setParameter('c', $criteria['certificat'])
            ->andWhere('off.datePub >= :d and off.datePub <= :no')
            ->setParameter('d', $criteria['datePub'])
            ->setParameter('no', $now)
            ->andWhere('off.valide = :a')
            ->setParameter('a', 1)
            ->getQuery()
            ->getResult();

    }
}
