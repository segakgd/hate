<?php

namespace App\Tests\Unit\Mapper\Ecommerce;

use App\Dto\Ecommerce\FieldDto;
use App\Entity\Lead\Field;
use App\Mapper\Ecommerce\FieldMapper;
use App\Tests\Unit\UnitTestCase;
use DateTimeImmutable;
use ReflectionException;

class FieldMapperTest extends UnitTestCase
{
    /**
     * @throws ReflectionException
     */
    public function testMapToDto(): void
    {
        $entity = (new Field())
            ->setName('Поле Имя')
            ->setValue('Эрик')
            ->setCreatedAt(new DateTimeImmutable())
        ;

        $dto = FieldMapper::mapToDto($entity);

        $this->assertObjectProperties(
            $dto,
            [
                'name' => 'Поле Имя',
                'value' => 'Эрик',
            ]
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMapToEntity(): void
    {
        $dto = (new FieldDto())
            ->setName('Имя поля')
            ->setValue('Значение')
        ;

        $entity = FieldMapper::mapToEntity($dto);

        $this->assertObjectProperties(
            $entity,
            [
                'name' => 'Имя поля',
                'value' => 'Значение',
            ]
        );
    }
}