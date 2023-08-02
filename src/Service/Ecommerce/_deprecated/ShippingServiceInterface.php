<?php

namespace App\Service\Ecommerce\_deprecated;

use App\Dto\Ecommerce\_deprecated\ShippingDto;
use App\Entity\Ecommerce\ShippingEntity;

/** @deprecated временно не смотрим на этот код */
interface ShippingServiceInterface
{
    public function getOne(int $projectId, int $shippingId): ?ShippingEntity;

    public function getAll(int $projectId): array;

    public function add(ShippingDto $shippingDto, int $projectId): ShippingEntity;

    public function update(ShippingDto $shippingDto, int $projectId, int $shippingId): ShippingEntity;

    public function remove(int $projectId, int $shippingId): bool;
}