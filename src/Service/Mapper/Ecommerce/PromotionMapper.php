<?php

namespace App\Service\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\PromotionDto;
use App\Entity\Ecommerce\Promotion;

class PromotionMapper
{
    public static function mapToDto(Promotion $entity): PromotionDto
    {
        return self::mapToExistDto($entity, (new PromotionDto()));
    }

    public static function mapToEntity(PromotionDto $dto): Promotion
    {
        return self::mapToExistEntity($dto, (new Promotion()));
    }

    public static function mapToExistDto(Promotion $entity, PromotionDto $dto): PromotionDto
    {
        return $dto
            ->setName($entity->getName())
            ->setType($entity->getType())
            ->setPrice(PriceMapper::toDtoFromArr($entity->getPrice()))
            ->setActive($entity->isActive())
            ->setCode($entity->getCode())
            ->setCount($entity->getCount())
            ;
    }

    public static function mapToExistEntity(PromotionDto $dto, Promotion $entity): Promotion
    {
        if ($name = $dto->getName()){
            $entity->setName($name);
        }

        if ($type = $dto->getType()){
            $entity->setType($type);
        }

        if ($price = $dto->getPrice()){
            $entity->setPrice(PriceMapper::toArrFromDto($price));
        }

        if ($active = $dto->getActive()){
            $entity->setActive($active);
        }

        if ($code = $dto->getCode()){
            $entity->setCode($code);
        }

        if ($count = $dto->getCount()){
            $entity->setCount($count);
        }

        return $entity;
    }
}
