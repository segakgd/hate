<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\ProductDto;
use App\Entity\Ecommerce\ProductEntity;

class ProductMapper
{
    public static function mapToDto(ProductEntity $productEntity): ProductDto
    {
        return (new ProductDto)
            ->setName($productEntity->getName())
            ->setImage($productEntity->getImage())
            ->setPrice(PriceMapper::toDtoFromArr($productEntity->getPrice()))
        ;
    }

    public static function mapToEntity(ProductDto $productDto): ProductEntity
    {
        $productEntity = new ProductEntity();

        if ($name = $productDto->getName()){
            $productEntity->setName($name);
        }

        if ($image = $productDto->getImage()){
            $productEntity->setImage($image);
        }

        if ($price = $productDto->getPrice()){
            $productEntity->setPrice(PriceMapper::toArrFromDto($price));
        }

        return $productEntity;
    }

    public static function mapToExistDto(ProductEntity $productEntity, ProductDto $productDto): ProductDto
    {
        return $productDto
            ->setName($productEntity->getName())
            ->setPrice(PriceMapper::toDtoFromArr($productEntity->getPrice()))
            ->setImage($productEntity->getImage())
            ;
    }

    public static function mapToExistEntity(ProductDto $productDto, ProductEntity $productEntity): ProductEntity
    {
        if ($name = $productDto->getName()){
            $productEntity->setName($name);
        }

        if ($image = $productDto->getImage()){
            $productEntity->setImage($image);
        }

        if ($price = $productDto->getPrice()){
            $productEntity->setPrice(PriceMapper::toArrFromDto($price));
        }

        return $productEntity;
    }
}
