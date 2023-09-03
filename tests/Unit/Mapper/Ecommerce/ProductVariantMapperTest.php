<?php

namespace App\Tests\Unit\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\ProductCategoryDto;
use App\Dto\Ecommerce\ProductDto;
use App\Dto\Ecommerce\ProductVariantDto;
use App\Entity\Ecommerce\Product;
use App\Entity\Ecommerce\ProductCategory;
use App\Entity\Ecommerce\ProductVariant;
use App\Mapper\Ecommerce\ProductMapper;
use App\Mapper\Ecommerce\ProductVariantMapper;
use App\Tests\Unit\UnitTestCase;
use DateTimeImmutable;
use ReflectionException;

class ProductVariantMapperTest extends UnitTestCase
{

    /**
     * @throws ReflectionException
     */
    public function testMapToDto(): void
    {
        $dateTime = new DateTimeImmutable();

        $entity = (new ProductVariant())
            ->setName('Вариант продукта 1')
            ->setCount(9)
            ->setPrice(
                [
                    'value' => 10000,
                    'valueFraction' => '100',
                ]
            )
            ->setActive(true)
            ->setActiveTo($dateTime)
            ->setActiveFrom($dateTime)
            ->setPercentDiscount(10)
            ->setPromotionDistributed(true)
        ;

        $dto = ProductVariantMapper::mapToDto($entity);

        $this->assertObjectProperties(
            $dto,
            [
                'name' => 'Вариант продукта 1',
                'count' => 9,
                'price' => [
                    'value' => 10000,
                    'valueFraction' => '100',
                ],
                'active' => true,
                'activeTo' => $dateTime,
                'activeFrom' => $dateTime,
                'percentDiscount' => 10,
                'promotionDistributed' => true,
            ]
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMapToEntity(): void
    {
        $dateTime = new DateTimeImmutable();

        $dto = (new ProductVariantDto())
            ->setName('Вариант продукта 1')
            ->setCount(9)
            ->setPrice(
                [
                    'value' => 10000,
                    'valueFraction' => '100',
                ]
            )
            ->setActive(true)
            ->setActiveTo($dateTime)
            ->setActiveFrom($dateTime)
            ->setPercentDiscount(10)
            ->setPromotionDistributed(true)
        ;

        $entity = ProductVariantMapper::mapToEntity($dto);

        $this->assertObjectProperties(
            $entity,
            [
                'name' => 'Вариант продукта 1',
                'count' => 9,
                'price' => [
                    'value' => 10000,
                    'valueFraction' => '100',
                ],
                'active' => true,
                'activeTo' => $dateTime,
                'activeFrom' => $dateTime,
                'percentDiscount' => 10,
                'promotionDistributed' => true,
            ]
        );
    }
}
