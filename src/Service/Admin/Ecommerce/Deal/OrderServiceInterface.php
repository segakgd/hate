<?php

namespace App\Service\Admin\Ecommerce\Deal;

use App\Dto\Ecommerce\OrderDto;
use App\Entity\Lead\DealOrder;

interface OrderServiceInterface
{
    public function add(OrderDto $dto): DealOrder;

    public function update(OrderDto $dto): ?DealOrder;
}