<?php

namespace App\Service\Ecommerce\_deprecated;

use App\Dto\Ecommerce\_deprecated\PromotionDto;
use App\Entity\Ecommerce\Promotion;

/** @deprecated временно не смотрим на этот код */
interface PromotionServiceInterface
{
    public function getOne(int $projectId, int $promotionId): ?Promotion;

    public function getAll(int $projectId): array;

    public function add(PromotionDto $promotionDto, int $projectId): Promotion;

    public function update(PromotionDto $promotionDto, int $projectId, int $promotionId): Promotion;

    public function remove(int $projectId, int $promotionId): bool;
}