<?php

namespace App\Entity;

use App\Entity\SupplierInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SupplierInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupplierInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupplierInformation[]    findAll()
 * @method SupplierInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupplierInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupplierInformation::class);
    }

    // /**
    //  * @return SupplierInformation[] Returns an array of SupplierInformation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SupplierInformation
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
