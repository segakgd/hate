<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\ProductCategoryDto;
use App\Entity\Ecommerce\ProductCategory;

/** @deprecated пока что не используем */
class ProductCategoryMapper
{
    public static function mapToDto(ProductCategory $entity): ProductCategoryDto
    {
        return self::mapToExistDto($entity, (new ProductCategoryDto));
    }

    public static function mapToEntity(ProductCategoryDto $dto): ProductCategory
    {
        return self::mapToExistEntity($dto, (new ProductCategory));
    }

    public static function mapToExistDto(ProductCategory $entity, ProductCategoryDto $dto): ProductCategoryDto
    {
        return $dto
            ->setId($entity->getId())
            ->setName($entity->getName())
            ;
    }

    public static function mapToExistEntity(ProductCategoryDto $dto, ProductCategory $entity): ProductCategory
    {
        if ($name = $dto->getName()){
            $entity->setName($name);
        }

        return $entity;
    }
}
