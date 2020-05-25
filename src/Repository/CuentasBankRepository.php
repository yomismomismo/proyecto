<?php

namespace App\Repository;

use App\Entity\CuentasBank;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CuentasBank|null find($id, $lockMode = null, $lockVersion = null)
 * @method CuentasBank|null findOneBy(array $criteria, array $orderBy = null)
 * @method CuentasBank[]    findAll()
 * @method CuentasBank[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuentasBankRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CuentasBank::class);
    }

    // /**
    //  * @return CuentasBank[] Returns an array of CuentasBank objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CuentasBank
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
