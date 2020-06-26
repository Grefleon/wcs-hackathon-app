<?php

namespace App\Repository;

use App\Entity\GoalSection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GoalSection|null find($id, $lockMode = null, $lockVersion = null)
 * @method GoalSection|null findOneBy(array $criteria, array $orderBy = null)
 * @method GoalSection[]    findAll()
 * @method GoalSection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GoalSectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GoalSection::class);
    }

    // /**
    //  * @return GoalSection[] Returns an array of GoalSection objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GoalSection
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
