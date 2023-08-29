<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\ProductCategoryDto;
use App\Entity\Ecommerce\ProductCategory;

/** @deprecated пока что не используем */
class ProductCategoryMapper
{
    public static function mapToDto(ProductCategory $productCategoryEntity): ProductCategoryDto
    {
        return (new ProductCategoryDto)
            ->setId($productCategoryEntity->getId())
            ->setName($productCategoryEntity->getName())
            ;
    }

    public static function mapToEntity(ProductCategoryDto $productCategoryDto): ProductCategory
    {
        $productCategoryEntity = new ProductCategory();

        if ($name = $productCategoryDto->getName()){
            $productCategoryEntity->setName($name);
        }

        return $productCategoryEntity;
    }

    public static function mapToExistDto(ProductCategory $productCategoryEntity, ProductCategoryDto $productCategoryDto): ProductCategoryDto
    {
        return $productCategoryDto
            ->setId($productCategoryEntity->getId())
            ->setName($productCategoryEntity->getName())
            ;
    }

    public static function mapToExistEntity(ProductCategoryDto $productCategoryDto, ProductCategory $productCategoryEntity): ProductCategory
    {
        if ($name = $productCategoryDto->getName()){
            $productCategoryEntity->setName($name);
        }

        return $productCategoryEntity;
    }
}
