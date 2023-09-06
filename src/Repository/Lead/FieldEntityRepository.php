<?php

namespace App\Repository\Lead;

use App\Entity\Lead\Field;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Field>
 *
 * @method Field|null find($id, $lockMode = null, $lockVersion = null)
 * @method Field|null findOneBy(array $criteria, array $orderBy = null)
 * @method Field[]    findAll()
 * @method Field[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FieldEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Field::class);
    }

    public function save(Field $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) { // todo
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Field $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
