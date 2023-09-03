<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\PromotionDto;
use App\Entity\Ecommerce\Promotion;

class PromotionMapper
{
    public static function mapToDto(Promotion $promotionEntity): PromotionDto
    {
        return self::mapToExistDto($promotionEntity, (new PromotionDto()));
    }

    public static function mapToEntity(PromotionDto $promotionDto): Promotion
    {
        return self::mapToExistEntity($promotionDto, (new Promotion()));
    }

    public static function mapToExistDto(Promotion $promotionEntity, PromotionDto $promotionDto): PromotionDto
    {
        return $promotionDto
            ->setName($promotionEntity->getName())
            ->setType($promotionEntity->getType())
            ->setPrice(PriceMapper::toDtoFromArr($promotionEntity->getPrice()))
            ->setActive($promotionEntity->isActive())
            ->setCode($promotionEntity->getCode())
            ->setCount($promotionEntity->getCount())
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

        if ($active = $promotionDto->getActive()){
            $promotionEntity->setActive($active);
        }

        if ($code = $promotionDto->getCode()){
            $promotionEntity->setCode($code);
        }

        if ($count = $promotionDto->getCount()){
            $promotionEntity->setCount($count);
        }

        return $promotionEntity;
    }
}
