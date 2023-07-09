<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\OrderDto;
use App\Entity\Ecommerce\OrderEntity;

interface OrderServiceInterface
{
    public function getOrders(): array;

    public function getOrder(OrderDto $orderId): OrderEntity;

    public function addOrder($orderDto): OrderEntity;

    public function updateOrder(OrderDto $orderDto): OrderEntity;

    public function removeOrder(int $orderId): OrderEntity;
}