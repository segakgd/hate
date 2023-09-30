<?php

namespace App\Service\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\ProductCategoryDto;
use App\Entity\Ecommerce\ProductCategory;

class ProductCategoryMapper
{
    public static function mapToEntity(ProductCategoryDto $dto): ProductCategory
    {
        return self::mapToExistEntity($dto, (new ProductCategory));
    }

    public static function mapToExistEntity(ProductCategoryDto $dto, ProductCategory $entity): ProductCategory
    {
        if ($name = $dto->getName()){
            $entity->setName($name);
        }

        return $entity;
    }
}
