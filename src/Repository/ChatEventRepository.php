<?php

namespace App\Repository;

use App\Entity\ChatEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChatEvent>
 *
 * @method ChatEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChatEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChatEvent[]    findAll()
 * @method ChatEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChatEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChatEvent::class);
    }

    public function saveAndFlush(ChatEvent $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function remove(ChatEvent $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}
