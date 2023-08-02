<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ProductCategoryDto;
use App\Entity\Ecommerce\ProductCategoryEntity;

interface ProductCategoryServiceInterface
{
    public function getAll(int $projectId): array;

    public function getOne(int $projectId, int $productCategoryId): ?ProductCategoryEntity;

    public function add(ProductCategoryDto $productCategoryDto, int $projectId): ProductCategoryEntity;

    public function update(ProductCategoryDto $productCategoryDto, int $projectId, int $productCategoryId): ProductCategoryEntity;

    public function remove(int $projectId, int $productCategoryId): bool;
}