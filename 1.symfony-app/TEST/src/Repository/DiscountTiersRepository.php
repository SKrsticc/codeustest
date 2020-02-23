<?php

namespace App\Repository;

use App\Entity\DiscountTiers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DiscountTiers|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiscountTiers|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiscountTiers[]    findAll()
 * @method DiscountTiers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscountTiersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiscountTiers::class);
    }

    // /**
    //  * @return DiscountTiers[] Returns an array of DiscountTiers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DiscountTiers
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
