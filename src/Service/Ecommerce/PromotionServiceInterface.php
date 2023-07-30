<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\PromotionDto;
use App\Entity\Ecommerce\Promotion;

interface PromotionServiceInterface
{
    public function getPromotions(): array;

    public function getPromotion(int $promotionId): Promotion;

    public function addPromotion(PromotionDto $promotionDto): Promotion;

    public function updatePromotion(PromotionDto $promotionDto): Promotion;

    public function removePromotion(int $promotionId): Promotion;
}