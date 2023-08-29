<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\OrderDto;
use App\Entity\Lead\Order;

class OrderMapper
{
    public static function mapToDto(Order $entity): OrderDto
    {
        return self::mapToExistDto($entity, (new OrderDto));
    }

    public static function mapToEntity(OrderDto $dto): Order
    {
        return self::mapToExistEntity($dto, (new Order));
    }

    public static function mapToExistDto(Order $entity, OrderDto $dto): OrderDto
    {
        return $dto
            ->setProducts($entity->getProducts())
            ->setPromotions($entity->getPromotions())
            ->setShipping(ShippingMapper::mapToDtoFromArray($entity->getShipping()))
            ->setTotalAmount($entity->getTotalAmount())
            ;
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
            $entity->setShipping(ShippingMapper::mapToArrayFromDto($shipping));
        }

        if ($totalAmount = $dto->getTotalAmount()){
            $entity->setTotalAmount($totalAmount);
        }

        return $entity;
    }
}
