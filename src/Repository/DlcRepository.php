<?php

namespace App\Repository;

use App\Entity\Dlc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dlc>
 *
 * @method Dlc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dlc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dlc[]    findAll()
 * @method Dlc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DlcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dlc::class);
    }

    //    /**
    //     * @return Dlc[] Returns an array of Dlc objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Dlc
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
