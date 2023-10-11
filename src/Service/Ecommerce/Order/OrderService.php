<?php

namespace App\Service\Ecommerce\Order;

use App\Dto\Ecommerce\OrderDto;
use App\Entity\Lead\Order;
use App\Repository\Lead\OrderEntityRepository;

class OrderService
{
    public function __construct(
        private OrderEntityRepository $orderEntityRepository,
    ){
    }

    public function add(OrderDto $dto): Order
    {
        $entity = (new Order());

        $entity
            ->setValue($dto->getValue())
            ->setName($dto->getName())
        ;

        $this->orderEntityRepository->saveAndFlush($entity);

        return $entity;
    }

    public function update(OrderDto $dto): ?Order
    {
        $entity = $this->fieldEntityRepository->find($dto->getId());

        if (!$entity){
            $entity = (new Order());
        }

        $entity
            ->setValue($dto->getValue())
            ->setName($dto->getName())
        ;

        $this->orderEntityRepository->saveAndFlush($entity);

        return $entity;
    }
}