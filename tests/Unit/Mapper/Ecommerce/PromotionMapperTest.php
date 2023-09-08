<?php

namespace App\Tests\Unit\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\PromotionDto;
use App\Dto\Ecommerce\PriceDto;
use App\Entity\Ecommerce\Promotion;
use App\Service\Mapper\Ecommerce\PromotionMapper;
use App\Tests\Unit\UnitTestCase;
use ReflectionException;

class PromotionMapperTest extends UnitTestCase
{

    /**
     * @throws ReflectionException
     */
    public function testMapToDto(): void
    {
        $entity = (new Promotion())
            ->setName('Скидка 10 %')
            ->setType('code')
            ->setProjectId(1)
            ->setPrice(
                [
                    'value' => 10000,
                    'valueFraction' => '100',
                ]
            )
            ->setActive(true)
            ->setCode('MY CODE')
            ->setCount(2)
        ;

        $dto = PromotionMapper::mapToDto($entity);

        $this->assertObjectProperties(
            $dto,
            [
                'name' => 'Скидка 10 %',
                'type' => 'code',
                'price' => [
                    'value' => 10000,
                    'valueFraction' => '100',
                ],
                'active' => true,
                'code' => 'MY CODE',
                'count' => 2,
            ]
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMapToEntity(): void
    {

        $dto = (new PromotionDto())
            ->setName('Скидка 10 %')
            ->setType('code')
            ->setProjectId(1)
            ->setPrice(
                (new PriceDto())
                    ->setValue(10000)
                    ->setValueFraction('100')
            )
            ->setActive(true)
            ->setCode('MY CODE')
            ->setCount(2)
        ;

        $entity = PromotionMapper::mapToEntity($dto);

        $this->assertObjectProperties(
            $entity,
            [
                'name' => 'Скидка 10 %',
                'type' => 'code',
                'price' => [
                    'value' => 10000,
                    'valueFraction' => '100',
                ],
                'active' => true,
                'code' => 'MY CODE',
                'count' => 2,
            ]
        );
    }
}