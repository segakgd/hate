<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\ShippingDto;
use App\Dto\Ecommerce\PriceDto;
use App\Entity\Ecommerce\Shipping;

class ShippingMapper
{
    public static function mapToDtoFromArray(array $shipping): ShippingDto
    {
        if (is_array($shipping['price'])){
            $price = PriceMapper::toDtoFromArr($shipping['price']);
        } else {
            $price = (new PriceDto())
                ->setValue($shipping['price'])
                ->setValueFraction($shipping['price'] * 0.01)
            ;
        }

        return (new ShippingDto)
            ->setTitle($shipping['title'])
            ->setType($shipping['type'])
            ->setPrice($price)
            ;
    }

    public static function mapToArrayFromDto(ShippingDto $shipping): array
    {
        return [
            'title' => $shipping->getTitle(),
            'type' => $shipping->getType(),
            'price' => $shipping->getPrice(),
        ];
    }

    public static function mapToDto(Shipping $shippingEntity): ShippingDto
    {
        return (new ShippingDto)
            ->setTitle($shippingEntity->getTitle())
            ->setType($shippingEntity->getType())
            ->setPrice(PriceMapper::toDtoFromArr($shippingEntity->getPrice()))
            ;
    }

    public static function mapToEntity(ShippingDto $shippingDto): Shipping
    {
        $shippingEntity = new Shipping();

        if ($name = $shippingDto->getTitle()){
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
            ->setTitle($shippingEntity->getTitle())
            ->setType($shippingEntity->getType())
            ->setPrice(PriceMapper::toDtoFromArr($shippingEntity->getPrice()))
            ;
    }

    public static function mapToExistEntity(ShippingDto $shippingDto, Shipping $shippingEntity): Shipping
    {
        if ($name = $shippingDto->getTitle()){
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
