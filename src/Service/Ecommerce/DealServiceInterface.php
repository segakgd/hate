<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\DealDto;
use App\Entity\Ecommerce\DealEntity;

interface DealServiceInterface
{
    public function getDeals(int $projectId): array; // todo убрать наименование Deals из всех методов

    public function getDeal(int $projectId, int $dealId): ?DealEntity;

    public function addDeal(DealDto $dealDto, int $projectId): DealEntity;

    public function updateDeal(DealDto $dealDto, int $projectId, int $dealId): DealEntity;

    public function removeDeal(int $projectId, int $dealId): bool;
}