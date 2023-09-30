<?php

namespace App\Service\Mapper\Ecommerce;

use App\Dto\Ecommerce\OrderDto;
use App\Entity\Lead\Order;

class OrderMapper
{
    public static function mapToEntity(OrderDto $dto): Order
    {
        return self::mapToExistEntity($dto, (new Order));
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
