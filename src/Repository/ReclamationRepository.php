<?php

namespace App\Repository;

use App\Entity\Reclamation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reclamation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reclamation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reclamation[]    findAll()
 * @method Reclamation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReclamationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reclamation::class);
    }

    public function SearchName($data)
{
    return $this->createQueryBuilder('r')
        ->where('r.adressem LIKE :data')->orWhere('r.examen Like :data ')->orWhere('r.nomFormateur Like :data ')
        ->setParameter('data', '%'.$data.'%')
        ->getQuery()
        ->getResult()
        ;
}
 /*   public function findByadresse($adressem)
    {
        return $this->createQueryBuilder('p')
            ->where('p.adressem LIKE :p')
            ->setParameter('adressem', '%' . $adressem . '%')
            ->getQuery()
            ->getResult();
    }
 /*   public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e
                FROM Reclamation:Entity e
                WHERE e.adressem LIKE :str'
            )
           ->setParameter('str', '%'.$str.'%')
           ->getResult();
    }




    /*public function findByadresse($adressem){
        return $this->createQueryBuilder('p')
            ->where('p.adressem LIKE :p')
            ->setParameter	('adressem', '%'.$adressem.'%')
            ->getQuery()
            ->getResult();
    }
    /*///**
  /*   * @param $adressem
     * @return int|string
     */
    /*public function findByadresse($adressem)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.adressem LIKE :adressem')
            ->setParameter('adressem',REGEXP('%'.$adressem.'%'))
            ->getQuery()
            ->execute();
    }/*


    // /**
    //  * @return Reclamation[] Returns an array of Reclamation objects
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
    public function findOneBySomeField($value): ?Reclamation
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

