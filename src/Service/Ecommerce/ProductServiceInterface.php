<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ProductDto;
use App\Entity\Ecommerce\ProductEntity;

interface ProductServiceInterface
{
    public function getProducts(): array;

    public function getProduct(int $productId): ProductEntity;

    public function addProduct(ProductDto $productDto): ProductEntity;

    public function updateProduct(ProductDto $productDto): ProductEntity;

    public function removeProduct(int $productId): ProductEntity;
}