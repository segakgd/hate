<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\PromotionDto;
use App\Entity\Ecommerce\Promotion;

interface PromotionServiceInterface
{
    public function getPromotions(int $projectId): array;

    public function getPromotion(int $projectId, int $promotionId): Promotion;

    public function addPromotion(PromotionDto $promotionDto, int $projectId): Promotion;

    public function updatePromotion(PromotionDto $promotionDto, int $projectId, int $promotionId): Promotion;

    public function removePromotion(int $projectId, int $promotionId): Promotion;
}