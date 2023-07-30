<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ShippingDto;
use App\Entity\Ecommerce\ShippingEntity;

class ShippingService implements ShippingServiceInterface
{
    public function getAllShipping(): array
    {
        return [];
    }

    public function getShipping(int $shippingId): ShippingEntity
    {
        return new ShippingEntity;
    }

    public function addShipping(ShippingDto $shippingDto): ShippingEntity
    {
        return new ShippingEntity;
    }

    public function updateShipping(ShippingDto $shippingDto): ShippingEntity
    {
        return new ShippingEntity;
    }

    public function removeShipping(int $shippingId): ShippingEntity
    {
        return new ShippingEntity;
    }
}