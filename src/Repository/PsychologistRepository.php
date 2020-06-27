<?php

namespace App\Repository;

use App\Entity\Psychologist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Psychologist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Psychologist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Psychologist[]    findAll()
 * @method Psychologist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PsychologistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Psychologist::class);
    }

    // /**
    //  * @return Psychologist[] Returns an array of Psychologist objects
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
    public function findOneBySomeField($value): ?Psychologist
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
