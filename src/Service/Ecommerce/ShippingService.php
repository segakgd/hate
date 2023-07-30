<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ShippingDto;
use App\Entity\Ecommerce\ShippingEntity;

class ShippingService implements ShippingServiceInterface
{
    public function getAllShipping(int $projectId): array
    {
        return [];
    }

    public function getShipping(int $projectId, int $shippingId): ShippingEntity
    {
        return new ShippingEntity;
    }

    public function addShipping(ShippingDto $shippingDto, int $projectId): ShippingEntity
    {
        return new ShippingEntity;
    }

    public function updateShipping(ShippingDto $shippingDto, int $projectId, int $shippingId): ShippingEntity
    {
        return new ShippingEntity;
    }

    public function removeShipping(int $projectId, int $shippingId): ShippingEntity
    {
        return new ShippingEntity;
    }
}