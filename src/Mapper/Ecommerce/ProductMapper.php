<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\ProductDto;
use App\Entity\Ecommerce\Product;

class ProductMapper
{
    public static function mapToArray(Product $productEntity): array
    {
        return [
            'id' => $productEntity->getId(),
            'name' => $productEntity->getName(),
            'price' => $productEntity->getPrice(),
        ];
    }

    public static function mapToDto(Product $productEntity): ProductDto
    {
        return (new ProductDto)
            ->setName($productEntity->getName())
            ->setImage($productEntity->getImage())
            ->setPrice(PriceMapper::toDtoFromArr($productEntity->getPrice()))
        ;
    }

    public static function mapToEntity(ProductDto $productDto): Product
    {
        $productEntity = new Product();

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

    public static function mapToExistDto(Product $productEntity, ProductDto $productDto): ProductDto
    {
        return $productDto
            ->setName($productEntity->getName())
            ->setPrice(PriceMapper::toDtoFromArr($productEntity->getPrice()))
            ->setImage($productEntity->getImage())
            ;
    }

    public static function mapToExistEntity(ProductDto $productDto, Product $productEntity): Product
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
