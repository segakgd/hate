<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\PromotionDto;
use App\Entity\Ecommerce\PromotionEntity;

interface PromotionServiceInterface
{
    public function get(int $projectId, int $promotionId): ?PromotionEntity; // todo getOne

    public function getAll(int $projectId): array;

    public function add(PromotionDto $promotionDto, int $projectId): PromotionEntity;

    public function update(PromotionDto $promotionDto, int $projectId, int $promotionId): PromotionEntity;

    public function remove(int $projectId, int $promotionId): bool;
}