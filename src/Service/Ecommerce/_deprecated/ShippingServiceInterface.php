<?php

namespace App\Service\Ecommerce\_deprecated;

use App\Dto\Ecommerce\_deprecated\ShippingDto;
use App\Entity\Ecommerce\Shipping;

/** @deprecated временно не смотрим на этот код */
interface ShippingServiceInterface
{
    public function getOne(int $projectId, int $shippingId): ?Shipping;

    public function getAll(int $projectId): array;

    public function add(ShippingDto $shippingDto, int $projectId): Shipping;

    public function update(ShippingDto $shippingDto, int $projectId, int $shippingId): Shipping;

    public function remove(int $projectId, int $shippingId): bool;
}