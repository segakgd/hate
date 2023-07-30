<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\PromotionDto;
use App\Entity\Ecommerce\Promotion;

class PromotionService implements PromotionServiceInterface
{
    public function getPromotions(int $projectId): array
    {
        return [];
    }

    public function getPromotion(int $projectId, int $promotionId): Promotion
    {
        return new Promotion;
    }

    public function addPromotion(PromotionDto $promotionDto, int $projectId): Promotion
    {
        return new Promotion;
    }

    public function updatePromotion(PromotionDto $promotionDto, int $projectId, int $promotionId): Promotion
    {
        return new Promotion;
    }

    public function removePromotion(int $projectId, int $promotionId): Promotion
    {
        return new Promotion;
    }
}