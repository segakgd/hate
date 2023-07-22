<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\ProductDto;
use App\Entity\Ecommerce\ProductEntity;

class ProductMapper
{
    public static function mapToDto(ProductEntity $productEntity): ProductDto
    {
        return (new ProductDto)
            ;
    }

    public static function mapToEntity(ProductDto $productDto): ProductEntity
    {
        return (new ProductEntity)
            ;
    }

    public static function mapToExistDto(ProductEntity $productEntity, ProductDto $productDto): ProductDto
    {
        return $productDto
            ;
    }

    public static function mapToExistEntity(ProductDto $productDto, ProductEntity $productEntity): ProductEntity
    {
        return $productEntity
            ;
    }
}