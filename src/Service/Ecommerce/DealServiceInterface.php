<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\DealDto;
use App\Entity\Ecommerce\DealEntity;

interface DealServiceInterface
{
    public function getAll(int $projectId): array;

    public function getOne(int $projectId, int $dealId): ?DealEntity;

    public function add(DealDto $dealDto, int $projectId): DealEntity;

    public function update(DealDto $dealDto, int $projectId, int $dealId): DealEntity;

    public function remove(int $projectId, int $dealId): bool;
}