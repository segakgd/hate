<?php

namespace App\Tests\Unit\Mapper\Ecommerce;

use App\Dto\Ecommerce\PriceDto;
use App\Mapper\Ecommerce\PriceMapper;
use App\Tests\Unit\UnitTestCase;
use ReflectionException;

class PriceMapperTest extends UnitTestCase
{
    /**
     * @throws ReflectionException
     */
    public function testMapToDtoFromArr(): void
    {
        $dto = PriceMapper::toDtoFromArr(
            [
                'value' => 10000,
                'valueFraction' => '100',
            ]
        );

        $this->assertObjectProperties(
            $dto,
            [
                'value' => 10000,
                'valueFraction' => '100',
            ]
        );
    }

    public function testMapToArrFromDto(): void
    {
        $dto = (new PriceDto())
            ->setValue(10000)
            ->setValueFraction('100')
        ;

        $arr = PriceMapper::toArrFromDto($dto);

        $this->assertEquals(
            [
                'value' => 10000,
                'valueFraction' => '100',
            ],
            $arr
        );
    }
}