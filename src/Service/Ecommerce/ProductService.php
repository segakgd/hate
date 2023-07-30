<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ProductDto;
use App\Entity\Ecommerce\ProductEntity;

class ProductService implements ProductServiceInterface
{
    public function getProducts(): array
    {
        return [];
    }

    public function getProduct(int $productId): ProductEntity
    {
        return new ProductEntity;
    }

    public function addProduct(ProductDto $productDto): ProductEntity
    {
        return new ProductEntity;
    }

    public function updateProduct(ProductDto $productDto): ProductEntity
    {
        return new ProductEntity;
    }

    public function removeProduct(int $productId): ProductEntity
    {
        return new ProductEntity;
    }
}