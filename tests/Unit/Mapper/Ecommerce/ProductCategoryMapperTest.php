<?php

namespace App\Tests\Unit\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\ProductCategoryDto;
use App\Entity\Ecommerce\ProductCategory;
use App\Mapper\Ecommerce\ProductCategoryMapper;
use App\Tests\Unit\UnitTestCase;
use ReflectionException;

class ProductCategoryMapperTest extends UnitTestCase
{

    /**
     * @throws ReflectionException
     */
    public function testMapToDto(): void
    {
        $entity = (new ProductCategory())
            ->setName('Категория 1')
            ->setProjectId(1)
        ;

        $dto = ProductCategoryMapper::mapToDto($entity);

        $this->assertObjectProperties(
            $dto,
            [
                'name' => 'Категория 1',
            ]
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMapToEntity(): void
    {
        $dto = (new ProductCategoryDto())
            ->setName('Категория 1')
        ;

        $entity = ProductCategoryMapper::mapToEntity($dto);

        $this->assertObjectProperties(
            $entity,
            [
                'name' => 'Категория 1',
            ]
        );
    }
}
