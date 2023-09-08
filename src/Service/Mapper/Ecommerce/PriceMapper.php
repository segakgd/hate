<?php

namespace App\Service\Mapper\Ecommerce;

use App\Dto\Ecommerce\PriceDto;

class PriceMapper
{
    public static function toDtoFromArr($priceArray): PriceDto
    {
        return (new PriceDto())
                ->setValue($priceArray['value'] ?? 0)
                ->setValueFraction($priceArray['valueFraction'] ?? 0)
            ;
    }

    public static function toArrFromDto(PriceDto $price): array
    {
        return [
            'value' => $price->getValue(),
            'valueFraction' => $price->getValueFraction(),
        ];
    }
}