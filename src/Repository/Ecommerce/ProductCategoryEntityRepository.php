<?php

namespace App\Repository\Ecommerce;

use App\Entity\Ecommerce\ProductCategoryEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductCategoryEntity>
 *
 * @method ProductCategoryEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductCategoryEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductCategoryEntity[]    findAll()
 * @method ProductCategoryEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductCategoryEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductCategoryEntity::class);
    }

    public function saveAndFlush(ProductCategoryEntity $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush($entity);
    }

    public function removeAndFlush(ProductCategoryEntity $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush($entity);
    }
}
