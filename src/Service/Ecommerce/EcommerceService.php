<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\PriceDto;
use App\Dto\Ecommerce\ProductDto;

/** @deprecated  */
class EcommerceService
{
    public function getProducts(): array
    {
        return [
            (new ProductDto)
                ->setName('Название товара')
                ->setImage('https://cdn.metro-cc.ru/ru/ru_pim_111550001001_00.png?maxwidth=1600&maxheight=1200&format=jpg&quality=90')
                ->setPrice(
                    (new PriceDto())
                        ->setValue(20000)
                        ->setValueFraction('200,00')
                ),
            (new ProductDto)
                ->setName('Название товара')
                ->setImage('https://cdn.metro-cc.ru/ru/ru_pim_112449001001_01.png?maxwidth=1600&maxheight=1200&format=jpg&quality=90')
                ->setPrice(
                    (new PriceDto())
                        ->setValue(20000)
                        ->setValueFraction('200,00')
                )
        ];
    }
}