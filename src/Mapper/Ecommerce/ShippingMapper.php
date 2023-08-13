<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\ShippingDto;
use App\Entity\Ecommerce\Shipping;

class ShippingMapper
{
    public static function mapToDto(Shipping $shippingEntity): ShippingDto
    {
        return (new ShippingDto)
            ->setName($shippingEntity->getTitle())
            ->setType($shippingEntity->getType())
            ->setPrice(PriceMapper::toDtoFromArr($shippingEntity->getPrice()))
            ;
    }

    public static function mapToEntity(ShippingDto $shippingDto): Shipping
    {
        $shippingEntity = new Shipping();

        if ($name = $shippingDto->getName()){
            $shippingEntity->setTitle($name);
        }

        if ($type = $shippingDto->getType()){
            $shippingEntity->setType($type);
        }

        if ($price = $shippingDto->getPrice()){
            $shippingEntity->setPrice(PriceMapper::toArrFromDto($price));
        }

        return $shippingEntity;
    }

    public static function mapToExistDto(Shipping $shippingEntity, ShippingDto $shippingDto): ShippingDto
    {
        return $shippingDto
            ->setName($shippingEntity->getTitle())
            ->setType($shippingEntity->getType())
            ->setPrice(PriceMapper::toDtoFromArr($shippingEntity->getPrice()))
            ;
    }

    public static function mapToExistEntity(ShippingDto $shippingDto, Shipping $shippingEntity): Shipping
    {
        if ($name = $shippingDto->getName()){
            $shippingEntity->setTitle($name);
        }

        if ($type = $shippingDto->getType()){
            $shippingEntity->setType($type);
        }

        if ($price = $shippingDto->getPrice()){
            $shippingEntity->setPrice(PriceMapper::toArrFromDto($price));
        }

        return $shippingEntity;
    }
}
