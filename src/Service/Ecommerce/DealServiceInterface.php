<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\DealDto;
use App\Entity\Ecommerce\DealEntity;

interface DealServiceInterface
{
    public function getDeals(int $projectId): array;

    public function getDeal(int $dealId): ?DealEntity;

    public function addDeal(int $projectId, DealDto $dealDto): DealEntity;

    public function updateDeal(DealDto $dealDto): DealEntity;

    public function removeDeal(int $dealId): bool;
}