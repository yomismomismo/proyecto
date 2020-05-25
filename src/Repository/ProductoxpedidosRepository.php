<?php

namespace App\Repository;

use App\Entity\Productoxpedidos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Productoxpedidos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Productoxpedidos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Productoxpedidos[]    findAll()
 * @method Productoxpedidos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductoxpedidosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productoxpedidos::class);
    }

    // /**
    //  * @return Productoxpedidos[] Returns an array of Productoxpedidos objects
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
    public function findOneBySomeField($value): ?Productoxpedidos
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
