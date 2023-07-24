<?php

namespace App\Repository;

use App\Entity\ProjectEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProjectEntity>
 *
 * @method ProjectEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectEntity[]    findAll()
 * @method ProjectEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectEntity::class);
    }

    public function saveAndFlush(ProjectEntity $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function removeAndFlush(ProjectEntity $entity): void
    {
        $this->getEntityManager()->remove($entity);

        $this->getEntityManager()->flush();
    }
}
