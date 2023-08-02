<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ProductDto;
use App\Entity\Ecommerce\ProductEntity;

interface ProductServiceInterface
{
    public function getAll(int $projectId): array;

    public function getOne(int $projectId, int $productId): ?ProductEntity;

    public function add(ProductDto $productDto, int $projectId): ProductEntity;

    public function update(ProductDto $productDto, int $projectId, int $productId): ProductEntity;

    public function remove(int $projectId, int $productId): bool;
}