<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ShippingDto;
use App\Entity\Ecommerce\ShippingEntity;

interface ShippingServiceInterface
{
    public function getAllShipping(int $projectId): array;

    public function getShipping(int $projectId, int $shippingId): ?ShippingEntity;

    public function addShipping(ShippingDto $shippingDto, int $projectId): ShippingEntity;

    public function updateShipping(ShippingDto $shippingDto, int $projectId, int $shippingId): ShippingEntity;

    public function removeShipping(int $projectId, int $shippingId): bool;
}