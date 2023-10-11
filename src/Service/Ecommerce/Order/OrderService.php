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

        $entity = self::mapToExistEntity($dto, $entity);

        $this->orderEntityRepository->saveAndFlush($entity);

        return $entity;
    }

    public function update(OrderDto $dto): ?Order
    {
        $entity = $this->orderEntityRepository->find($dto->getId());

        if (!$entity){
            $entity = (new Order());
        }

        $entity = self::mapToExistEntity($dto, $entity);

        $this->orderEntityRepository->saveAndFlush($entity);

        return $entity;
    }

    public static function mapToExistEntity(OrderDto $dto, Order $entity): Order
    {
        if ($products = $dto->getProducts()){
            foreach ($products as $product){
                $entity->addProduct($product);
            }
        }

        if ($promotions = $dto->getPromotions()){
            foreach ($promotions as $promotion){
                $entity->addPromotion($promotion);
            }
        }

        if ($shipping = $dto->getShipping()){
            $entity->setShipping($shipping->toArray());
        }

        if ($totalAmount = $dto->getTotalAmount()){
            $entity->setTotalAmount($totalAmount);
        }

        return $entity;
    }
}