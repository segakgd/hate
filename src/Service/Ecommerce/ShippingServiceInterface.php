<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ShippingDto;
use App\Entity\Ecommerce\ShippingEntity;

interface ShippingServiceInterface
{
    public function get(int $projectId, int $shippingId): ?ShippingEntity;

    public function getAll(int $projectId): array;

    public function add(ShippingDto $shippingDto, int $projectId): ShippingEntity;

    public function update(ShippingDto $shippingDto, int $projectId, int $shippingId): ShippingEntity;

    public function remove(int $projectId, int $shippingId): bool;
}