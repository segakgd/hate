<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\OrderDto;
use App\Entity\Lead\Order;

class OrderMapper
{
    public static function mapToDto(Order $orderEntity): OrderDto
    {
        return (new OrderDto)
            ;
    }

    public static function mapToEntity(OrderDto $orderDto): Order
    {
        return (new Order)
            ;
    }

    public static function mapToExistDto(Order $orderEntity, OrderDto $orderDto): OrderDto
    {
        return $orderDto
            ;
    }

    public static function mapToExistEntity(OrderDto $orderDto, Order $orderEntity): Order
    {
        return $orderEntity
            ;
    }
}
