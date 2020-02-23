<?php

namespace App\Repository;

use App\Entity\Vouchers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Vouchers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vouchers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vouchers[]    findAll()
 * @method Vouchers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VouchersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vouchers::class);
    }

    // /**
    //  * @return Vouchers[] Returns an array of Vouchers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vouchers
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
