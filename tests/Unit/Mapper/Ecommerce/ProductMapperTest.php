<?php

namespace App\Tests\Unit\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\ProductCategoryDto;
use App\Dto\Ecommerce\ProductDto;
use App\Dto\Ecommerce\ProductVariantDto;
use App\Entity\Ecommerce\Product;
use App\Entity\Ecommerce\ProductCategory;
use App\Entity\Ecommerce\ProductVariant;
use App\Mapper\Ecommerce\ProductMapper;
use App\Tests\Unit\UnitTestCase;
use DateTimeImmutable;
use ReflectionException;

class ProductMapperTest extends UnitTestCase
{

    /**
     * @throws ReflectionException
     */
    public function testMapToDto(): void
    {
        $dateTime = new DateTimeImmutable();

        $category = (new ProductCategory())
            ->setName('Категория 1')
            ->setProjectId(1)
        ;

        $variant = (new ProductVariant())
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

        $entity = (new Product())
            ->setProjectId(1)
            ->addVariant($variant)
            ->addCategory($category)
        ;

        $dto = ProductMapper::mapToDto($entity);

        $this->assertObjectProperties(
            $dto,
            [
                'projectId' => 1,
                'variants' => [
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
                ],
                'categories' => [
                    [
                        'name' => 'Категория 1',
                    ]
                ],
            ]
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMapToEntity(): void
    {
        $dateTime = new DateTimeImmutable();

        $category = (new ProductCategoryDto())
            ->setName('Категория 1')
        ;

        $variant = (new ProductVariantDto())
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

        $dto = (new ProductDto())
            ->setProjectId(1)
            ->addVariant($variant)
            ->addCategory($category)
        ;

        $entity = ProductMapper::mapToEntity($dto);

        $this->assertObjectProperties(
            $entity,
            [
                'projectId' => 1,
                'variants' => [
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
                ],
                'categories' => [
                    [
                        'name' => 'Категория 1',
                    ]
                ],
            ]
        );
    }
}