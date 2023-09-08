<?php

namespace App\Service\Mapper\Ecommerce;

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

    public static function mapToDto(Shipping $entity): ShippingDto
    {
        return self::mapToExistDto($entity, (new ShippingDto()));
    }

    public static function mapToEntity(ShippingDto $dto): Shipping
    {
        return self::mapToExistEntity($dto, (new Shipping()));
    }

    public static function mapToExistDto(Shipping $entity, ShippingDto $dto): ShippingDto
    {
        return $dto
            ->setTitle($entity->getTitle())
            ->setType($entity->getType())
            ->setPrice(PriceMapper::toDtoFromArr($entity->getPrice()))
            ;
    }

    public static function mapToExistEntity(ShippingDto $dto, Shipping $entity): Shipping
    {
        if ($name = $dto->getTitle()){
            $entity->setTitle($name);
        }

        if ($type = $dto->getType()){
            $entity->setType($type);
        }

        if ($price = $dto->getPrice()){
            $entity->setPrice(PriceMapper::toArrFromDto($price));
        }

        return $entity;
    }
}
