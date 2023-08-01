<?php

namespace App\Repository\Ecommerce;

use App\Entity\Ecommerce\PromotionEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PromotionEntity>
 *
 * @method PromotionEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromotionEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromotionEntity[]    findAll()
 * @method PromotionEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromotionEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromotionEntity::class);
    }

    public function saveAndFlush(PromotionEntity $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function removeAndFlush(PromotionEntity $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}
