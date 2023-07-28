<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\DealDto;
use App\Entity\Ecommerce\DealEntity;

interface DealServiceInterface
{
    public function getDeals(int $projectId): array;

    public function getDeal(int $projectId, int $dealId): ?DealEntity;

    public function addDeal(DealDto $dealDto, int $projectId): DealEntity;

    public function updateDeal(DealDto $dealDto, int $projectId, int $dealId): DealEntity;

    public function removeDeal( int $projectId, int $dealId): bool;
}