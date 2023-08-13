<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\PromotionDto;
use App\Entity\Ecommerce\Promotion;

class PromotionMapper
{
    public static function mapToDto(Promotion $promotionEntity): PromotionDto
    {
        return (new PromotionDto)
            ->setName($promotionEntity->getName())
            ->setType($promotionEntity->getType())
            ->setPrice(PriceMapper::toDtoFromArr($promotionEntity->getPrice()))
            ;
    }

    public static function mapToEntity(PromotionDto $promotionDto): Promotion
    {
        $promotionEntity = new Promotion();

        if ($name = $promotionDto->getName()){
            $promotionEntity->setName($name);
        }

        if ($type = $promotionDto->getType()){
            $promotionEntity->setType($type);
        }

        if ($price = $promotionDto->getPrice()){
            $promotionEntity->setPrice(PriceMapper::toArrFromDto($price));
        }

        return $promotionEntity;
    }

    public static function mapToExistDto(Promotion $promotionEntity, PromotionDto $promotionDto): PromotionDto
    {
        return $promotionDto
            ->setName($promotionEntity->getName())
            ->setType($promotionEntity->getType())
            ->setPrice(PriceMapper::toDtoFromArr($promotionEntity->getPrice()))
            ;
    }

    public static function mapToExistEntity(PromotionDto $promotionDto, Promotion $promotionEntity): Promotion
    {
        if ($name = $promotionDto->getName()){
            $promotionEntity->setName($name);
        }

        if ($type = $promotionDto->getType()){
            $promotionEntity->setType($type);
        }

        if ($price = $promotionDto->getPrice()){
            $promotionEntity->setPrice(PriceMapper::toArrFromDto($price));
        }

        return $promotionEntity;
    }
}
