<?php

namespace App\Repository;

use App\Entity\ClientPayment;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientPayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientPayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientPayment[]    findAll()
 * @method ClientPayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientPaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientPayment::class);
    }

    /**
     * @return mixed Returns an array of ClientPayment objects
     */
    public function findIncommingClientPayments(int $days)
    {
        return $this->createQueryBuilder('c')
            ->where('c.date <= :chooseDays')
            ->andWhere('c.date >= :today')
            ->setParameter('today', new DateTime())
            ->setParameter('chooseDays', new DateTime('today + ' . $days . 'days'))
            ->orderBy('c.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed Returns an array of ClientPayment objects
     */
    public function findByYear(string $year)
    {
        return $this->createQueryBuilder('c')
            ->addSelect('b')
            ->join('c.booking', 'b')
            ->where("c.status = 'paid'")
            ->andWhere("b.departure LIKE :year")
            ->setParameter('year', $year . '%')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return ClientPayment[] Returns an array of ClientPayment objects
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
    public function findOneBySomeField($value): ?ClientPayment
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
