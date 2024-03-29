<?php

namespace App\Repository;

use App\Entity\ZoneDeSante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ZoneDeSante|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZoneDeSante|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZoneDeSante[]    findAll()
 * @method ZoneDeSante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZoneDeSanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZoneDeSante::class);
    }

    // /**
    //  * @return ZoneDeSante[] Returns an array of ZoneDeSante objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ZoneDeSante
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
