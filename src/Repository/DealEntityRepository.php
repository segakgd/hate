<?php

namespace App\Repository;

use App\Entity\Ecommerce\DealEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DealEntity>
 *
 * @method DealEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method DealEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method DealEntity[]    findAll()
 * @method DealEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DealEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DealEntity::class);
    }

    public function saveAndFlush(DealEntity $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function removeAndFlush(DealEntity $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}
