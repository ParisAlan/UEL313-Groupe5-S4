<?php

namespace App\Repository;

use App\Entity\Liens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Liens>
 */
class LiensRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Liens::class);
    }
    public function findByMotcle($motcle): array
    {
        return $this->createQueryBuilder('l')
            ->join('l.motcles', 'm')
            ->where('m.id = :id')
            ->setParameter('id', $motcle->getId())
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Liens[] Returns an array of Liens objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Liens
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
