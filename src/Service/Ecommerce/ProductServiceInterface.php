<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ProductDto;
use App\Entity\Ecommerce\ProductEntity;

interface ProductServiceInterface
{
    public function getProducts(int $projectId): array;

    public function getProduct(int $projectId, int $productId): ?ProductEntity;

    public function addProduct(ProductDto $productDto, int $projectId): ProductEntity;

    public function updateProduct(ProductDto $productDto, int $projectId, int $productId): ProductEntity;

    public function removeProduct(int $projectId, int $productId): bool;
}