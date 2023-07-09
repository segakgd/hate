<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\DealDto;
use App\Entity\Ecommerce\DealEntity;

interface DealServiceInterface
{
    public function getDeals(): array;

    public function getDeal(DealDto $dealId): DealEntity;

    public function addDeal($dealDto): DealEntity;

    public function updateDeal(DealDto $dealDto): DealEntity;

    public function removeDeal(int $dealId): DealEntity;
}