<?php

namespace App\Repository;

use App\Entity\Booking;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    /**
     * @return mixed Returns an array of Booking objects
     */
    public function findAgentCommission(int $days)
    {
        return $this->createQueryBuilder('b')
            ->where('b.departure <= :chooseDays')
            ->andWhere('b.departure >= :today')
            ->setParameter('today', new DateTime('today'))
            ->setParameter('chooseDays', new DateTime('today + ' . $days . 'days'))
            ->orderBy('b.departure', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed Returns an array of Booking objects
     */
    public function findDaiCommission(int $days)
    {
        return $this->createQueryBuilder('b')
            ->where('b.returnDate <= :chooseDays')
            ->andWhere('b.returnDate >= :today')
            ->setParameter('today', new DateTime('today'))
            ->setParameter('chooseDays', new DateTime('today + ' . $days . 'days'))
            ->orderBy('b.departure', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed Returns an array of Booking objects
     */
    public function findUpcommingTrips(int $days)
    {
        return $this->createQueryBuilder('b')
            ->where('b.departure <= :chooseDays')
            ->andWhere('b.departure >= :today')
            ->setParameter('today', new DateTime('today'))
            ->setParameter('chooseDays', new DateTime('today + ' . $days . 'days'))
            ->orderBy('b.departure', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
    * @return mixed Returns an array of Booking objects
    */
    public function findCurrentTrips()
    {
        return $this->createQueryBuilder('b')
            ->where('b.departure <= :today')
            ->andWhere('b.returnDate >= :today')
            ->setParameter('today', new DateTime('today'))
            ->orderBy('b.departure', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed Returns an array of Booking objects
     */
    public function findReturnedTrips(int $days)
    {
        return $this->createQueryBuilder('b')
            ->where('b.returnDate <= :today')
            ->andWhere('b.returnDate <= :fifteenDays')
            ->setParameter('today', new DateTime('today'))
            ->setParameter('fifteenDays', new DateTime('today + ' . $days . 'days'))
            ->orderBy('b.departure', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed Returns an array of Booking objects
     */
    public function findByYear(string $year)
    {
        return $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.departure LIKE :year')
            ->setParameter('year', $year . '%')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Booking[] Returns an array of Booking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Booking
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
