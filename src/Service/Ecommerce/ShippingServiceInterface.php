<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ShippingDto;
use App\Entity\Ecommerce\ShippingEntity;

interface ShippingServiceInterface
{
    public function getAllShipping(): array;

    public function getShipping(int $shippingId): ShippingEntity;

    public function addShipping(ShippingDto $shippingDto): ShippingEntity;

    public function updateShipping(ShippingDto $shippingDto): ShippingEntity;

    public function removeShipping(int $shippingId): ShippingEntity;
}