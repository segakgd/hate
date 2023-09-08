<?php

namespace App\Tests\Unit\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\ShippingDto;
use App\Dto\Ecommerce\PriceDto;
use App\Entity\Ecommerce\Shipping;
use App\Service\Mapper\Ecommerce\ShippingMapper;
use App\Tests\Unit\UnitTestCase;
use ReflectionException;

class ShippingMapperTest extends UnitTestCase
{

    /**
     * @throws ReflectionException
     */
    public function testMapToDto(): void
    {
        $entity = (new Shipping())
            ->setTitle('Доставка до дома')
            ->setType('courier')
            ->setPrice(
                [
                    'value' => 10000,
                    'valueFraction' => '100',
                ]
            )
            ->setProjectId(1)
        ;

        $dto = ShippingMapper::mapToDto($entity);

        $this->assertObjectProperties(
            $dto,
            [
                'title' => 'Доставка до дома',
                'type' => 'courier',
                'price' => [
                    'value' => 10000,
                    'valueFraction' => '100',
                ],
            ]
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMapToEntity(): void
    {
        $dto = (new ShippingDto())
            ->setTitle('Доставка до дома')
            ->setType('courier')
            ->setPrice(
                (new PriceDto())
                    ->setValue(10000)
                    ->setValueFraction('100')
            )
        ;

        $entity = ShippingMapper::mapToEntity($dto);

        $this->assertObjectProperties(
            $entity,
            [

                'title' => 'Доставка до дома',
                'type' => 'courier',
                'price' => [
                    'value' => 10000,
                    'valueFraction' => '100',
                ],
            ]
        );
    }
}
