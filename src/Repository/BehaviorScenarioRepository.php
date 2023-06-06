<?php

namespace App\Repository;

use App\Entity\BehaviorScenario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BehaviorScenario>
 *
 * @method BehaviorScenario|null find($id, $lockMode = null, $lockVersion = null)
 * @method BehaviorScenario|null findOneBy(array $criteria, array $orderBy = null)
 * @method BehaviorScenario[]    findAll()
 * @method BehaviorScenario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BehaviorScenarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BehaviorScenario::class);
    }

    public function save(BehaviorScenario $entity): void
    {
        $this->getEntityManager()->persist($entity);

        $this->getEntityManager()->flush();
    }

    public function remove(BehaviorScenario $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Step[] Returns an array of Step objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Step
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
