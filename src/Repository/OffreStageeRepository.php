<?php

namespace App\Repository;

use App\Entity\OffreStage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OffreStage|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffreStage|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffreStage[]    findAll()
 * @method OffreStage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreStageeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreStage::class);
    }

   public function FindOS($criteria){
        $now= new \DateTime('today');
        return $this->createQueryBuilder('off')
            ->andWhere('off.nivEtude = :n')
            ->setParameter('n', $criteria['nivEtude'])
            ->andWhere('off.certificat = :c')
            ->setParameter('c', $criteria['certificat'])
            ->andWhere('off.dateDebut <= :d and off.dateDebut >= :no')
            ->setParameter('d', $criteria['dateDebut'])
            ->setParameter('no', $now)
            ->getQuery()
            ->getResult();

   }

}
