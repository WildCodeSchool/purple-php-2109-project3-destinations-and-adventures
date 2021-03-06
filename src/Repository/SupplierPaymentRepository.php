<?php

namespace App\Repository;

use App\Entity\SupplierPayment;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SupplierPayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupplierPayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupplierPayment[]    findAll()
 * @method SupplierPayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupplierPaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupplierPayment::class);
    }

    /**
     * @return mixed Returns an array of SupplierPayment objects
     */
    public function findOucommingSupplierPayments(int $days)
    {
        return $this->createQueryBuilder('s')
            ->where('s.date <= :chooseDays')
            ->andWhere('s.date >= :today')
            ->setParameter('today', new DateTime('today'))
            ->setParameter('chooseDays', new DateTime('today + ' . $days . 'days'))
            ->orderBy('s.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed Returns an array of SupplierPayment objects
     */
    public function findAllSupplierPaymentsFromToday()
    {
        return $this->createQueryBuilder('s')
            ->where('s.date >= :today')
            ->setParameter('today', new DateTime('today'))
            ->orderBy('s.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed Returns an array of SupplierPayment objects
     */
    public function findOucommingSupplierCommissions(int $days)
    {
        return $this->createQueryBuilder('s')
            ->where('s.dueDateCommission <= :chooseDays')
            ->andWhere('s.dueDateCommission >= :today')
            ->setParameter('today', new DateTime('today'))
            ->setParameter('chooseDays', new DateTime('today + ' . $days . 'days'))
            ->orderBy('s.dueDateCommission', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed Returns an array of SupplierPayment objects
     */
    public function findAllSupplierCommissionsFromToday()
    {
        return $this->createQueryBuilder('s')
            ->where('s.dueDateCommission >= :today')
            ->setParameter('today', new DateTime('today'))
            ->orderBy('s.dueDateCommission', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed Returns an array of SupplierPayment objects
     */
    public function findByYear(string $year)
    {
        return $this->createQueryBuilder('s')
            ->addSelect('b')
            ->join('s.booking', 'b')
            ->where("s.status = 'paid'")
            ->andWhere("b.departure LIKE :year")
            ->setParameter('year', $year . '%')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return SupplierPayment[] Returns an array of SupplierPayment objects
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
    public function findOneBySomeField($value): ?SupplierPayment
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
