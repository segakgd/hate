<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\OrderDto;
use App\Entity\Ecommerce\OrderEntity;

class OrderMapper
{
    public static function mapToDto(OrderEntity $orderEntity): OrderDto
    {
        return (new OrderDto)
            ;
    }

    public static function mapToEntity(OrderDto $orderDto): OrderEntity
    {
        return (new OrderEntity)
            ;
    }

    public static function mapToExistDto(OrderEntity $orderEntity, OrderDto $orderDto): OrderDto
    {
        return $orderDto
            ;
    }

    public static function mapToExistEntity(OrderDto $orderDto, OrderEntity $orderEntity): OrderEntity
    {
        return $orderEntity
            ;
    }
}
