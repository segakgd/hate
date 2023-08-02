<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\OrderDto;
use App\Entity\Ecommerce\OrderEntity;

interface EcommerceServiceInterface
{
    public function getOrders(): array; // todo убрать наименование Order из всех методов

    public function getOrder(OrderDto $orderId): OrderEntity;

    public function addOrder($orderDto): OrderEntity;

    public function updateOrder(OrderDto $orderDto): OrderEntity;

    public function removeOrder(int $orderId): OrderEntity;
}