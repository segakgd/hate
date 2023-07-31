<?php

namespace App\Repository\Ecommerce;

use App\Entity\Ecommerce\ShippingEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShippingEntity>
 *
 * @method ShippingEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShippingEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShippingEntity[]    findAll()
 * @method ShippingEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippingEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShippingEntity::class);
    }

    public function saveAndFlush(ShippingEntity $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush($entity);
    }

    public function removeAndFlush(ShippingEntity $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush($entity);
    }
}
