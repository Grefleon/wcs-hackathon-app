<?php

namespace App\Repository;

use App\Entity\ExperienceList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExperienceList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExperienceList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExperienceList[]    findAll()
 * @method ExperienceList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExperienceListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExperienceList::class);
    }

    // /**
    //  * @return ExperienceList[] Returns an array of ExperienceList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExperienceList
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
