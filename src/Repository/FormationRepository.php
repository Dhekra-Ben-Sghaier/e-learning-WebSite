<?php

namespace App\Repository;

use App\Entity\Formation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Builder\Property;

/**
 * @method Formation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formation[]    findAll()
 * @method Formation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formation::class);
    }

    /**
     *  @return Formation[]
     */
    public function findAllVisible(): array
    {
        return $this->findAll()

            ->getQuery()
            ->getResult();
    }

    /*/**
     * @param $type
     * @return int|mixed|string
     */
   /* function searchByNom($nom){
        return $this->createQueryBuilder('f')
            ->where('f. =:nom')
            ->setParameter('nom' , $nom)
            ->getQuery()->getResult();
    }*/


    /**
     * @param $titre
     * @return int|mixed|string
     */
    public function findByTitre($titre)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.titre LIKE :titre')
            ->setParameter('titre',REGEXP('%'.$titre.'%'))
            ->getQuery()
            ->execute();
    }
    // /**
    //  * @return Formation[] Returns an array of Formation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Formation
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
