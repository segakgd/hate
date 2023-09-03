<?php

namespace App\Tests\Unit\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\PromotionDto;
use App\Dto\Ecommerce\_deprecated\ShippingDto;
use App\Dto\Ecommerce\OrderDto;
use App\Dto\Ecommerce\PriceDto;
use App\Dto\Ecommerce\ProductDto;
use App\Entity\Lead\Order;
use App\Mapper\Ecommerce\OrderMapper;
use App\Tests\Unit\UnitTestCase;
use DateTimeImmutable;
use ReflectionException;

class OrderMapperTest extends UnitTestCase
{
    /**
     * @throws ReflectionException
     */
    public function testMapToDto(): void
    {
        $dateTime = new DateTimeImmutable();

        $productDto = (new ProductDto())
            ->setProjectId(1)
            ->setUpdatedAt($dateTime)
            ->setCreatedAt($dateTime)
        ;

        $promotionDto = (new PromotionDto())
            ->setName('Скидка 10 %')
        ;

        $shippingDto = [
            'id' => 1,
            'title' => 'Доставка до дома',
            'type' => 'courier',
            'price' => '100',
        ];

        $entity = (new Order())
            ->addProduct($productDto)
            ->addPromotion($promotionDto)
            ->setShipping($shippingDto)
            ->setTotalAmount(10000)
            ->setCreatedAt($dateTime)
            ->setUpdatedAt($dateTime)
        ;

        $dto = OrderMapper::mapToDto($entity);

        $this->assertObjectProperties(
            $dto,
            [
                'products' => [
                    [
                        'projectId' => 1
                    ]
                ],
                'promotions' => [
                    [
                        'name' => 'Скидка 10 %'
                    ]
                ],
                'shipping' => [
                    'title' => 'Доставка до дома',
                    'type' => 'courier',
                    'price' => [
                        'value' => 100,
                    ],
                ],
                'totalAmount' => 10000,
            ]
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMapToEntity(): void
    {
        $dateTime = new DateTimeImmutable();

        $productDto = (new ProductDto())
            ->setProjectId(1)
            ->setUpdatedAt($dateTime)
            ->setCreatedAt($dateTime)
        ;

        $promotionDto = (new PromotionDto())
            ->setName('Скидка 10 %')
        ;

        $shippingDto = (new ShippingDto())
            ->setTitle('Доставка до дома')
            ->setType('courier')
            ->setPrice(
                (new PriceDto())
                    ->setValue(10000)
                    ->setValueFraction('100')
            )
        ;

        $dto = (new OrderDto())
            ->addProduct(
                $productDto
            )
            ->addPromotion($promotionDto)
            ->setShipping($shippingDto)
            ->setTotalAmount(10000)
        ;

        $entity = OrderMapper::mapToEntity($dto);

        $this->assertObjectProperties(
            $entity,
            [
                'products' => [
                    [
                        'projectId' => 1
                    ]
                ],
                'promotions' => [
                    [
                        'name' => 'Скидка 10 %'
                    ]
                ],
                'shipping' => [
                    'title' => 'Доставка до дома',
                    'type' => 'courier',
                    'price' => [
                        'value' => 10000,
                    ],
                ],
                'totalAmount' => 10000,
            ]
        );
    }

}