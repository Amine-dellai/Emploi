<?php

namespace App\Repository;

use App\Entity\EmploiDuTemps;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmploiDuTemps>
 */
class EmploiDuTempsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        // Corrected to reference the EmploiDuTemps entity class
        parent::__construct($registry, EmploiDuTemps::class);
    }

    // Example method to find records based on a field
    // Uncomment and modify as needed
    // /**
    //  * @return EmploiDuTemps[] Returns an array of EmploiDuTemps objects
    //  */
    // public function findByExampleField($value): array
    // {
    //     return $this->createQueryBuilder('e')
    //         ->andWhere('e.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('e.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult();
    // }

    // Uncomment and modify as needed
    // public function findOneBySomeField($value): ?EmploiDuTemps
    // {
    //     return $this->createQueryBuilder('e')
    //         ->andWhere('e.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult();
    // }
}
