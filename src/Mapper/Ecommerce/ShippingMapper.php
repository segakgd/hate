<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\ShippingDto;
use App\Entity\Ecommerce\ShippingEntity;

class ShippingMapper
{
    public static function mapToDto(ShippingEntity $shippingEntity): ShippingDto
    {
        return (new ShippingDto)
            ->setName($shippingEntity->getTitle())
            ->setPrice(PriceMapper::toDtoFromArr($shippingEntity->getPrice()))
            ;
    }

    public static function mapToEntity(ShippingDto $shippingDto): ShippingEntity
    {
        $shippingEntity = new ShippingEntity();

        if ($name = $shippingDto->getName()){
            $shippingEntity->setTitle($name);
        }

        if ($price = $shippingDto->getPrice()){
            $shippingEntity->setPrice(PriceMapper::toArrFromDto($price));
        }

        return $shippingEntity;
    }

    public static function mapToExistDto(ShippingEntity $shippingEntity, ShippingDto $shippingDto): ShippingDto
    {
        return $shippingDto
            ->setName($shippingEntity->getTitle())
            ->setPrice(PriceMapper::toDtoFromArr($shippingEntity->getPrice()))
            ;
    }

    public static function mapToExistEntity(ShippingDto $shippingDto, ShippingEntity $shippingEntity): ShippingEntity
    {
        if ($name = $shippingDto->getName()){
            $shippingEntity->setTitle($name);
        }

        if ($price = $shippingDto->getPrice()){
            $shippingEntity->setPrice(PriceMapper::toArrFromDto($price));
        }

        return $shippingEntity;
    }
}
