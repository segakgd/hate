<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\PromotionDto;
use App\Entity\Ecommerce\Promotion;

class PromotionService implements PromotionServiceInterface
{
    public function getPromotions(): array
    {
        return [];
    }

    public function getPromotion(int $promotionId): Promotion
    {
        return new Promotion;
    }

    public function addPromotion(PromotionDto $promotionDto): Promotion
    {
        return new Promotion;
    }

    public function updatePromotion(PromotionDto $promotionDto): Promotion
    {
        return new Promotion;
    }

    public function removePromotion(int $promotionId): Promotion
    {
        return new Promotion;
    }
}