<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\_deprecated\ProductCategoryDto;
use App\Entity\Ecommerce\ProductCategoryEntity;

class ProductCategoryMapper
{
    public static function mapToDto(ProductCategoryEntity $productCategoryEntity): ProductCategoryDto
    {
        return (new ProductCategoryDto)
            ->setName($productCategoryEntity->getName())
            ;
    }

    public static function mapToEntity(ProductCategoryDto $productCategoryDto): ProductCategoryEntity
    {
        $productCategoryEntity = new ProductCategoryEntity();

        if ($name = $productCategoryDto->getName()){
            $productCategoryEntity->setName($name);
        }

        return $productCategoryEntity;
    }

    public static function mapToExistDto(ProductCategoryEntity $productCategoryEntity, ProductCategoryDto $productCategoryDto): ProductCategoryDto
    {
        return $productCategoryDto
            ->setName($productCategoryEntity->getName())
            ;
    }

    public static function mapToExistEntity(ProductCategoryDto $productCategoryDto, ProductCategoryEntity $productCategoryEntity): ProductCategoryEntity
    {
        if ($name = $productCategoryDto->getName()){
            $productCategoryEntity->setName($name);
        }

        return $productCategoryEntity;
    }
}
