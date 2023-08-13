<?php

namespace App\Service\Ecommerce\_deprecated;

use App\Dto\Ecommerce\_deprecated\ProductCategoryDto;
use App\Entity\Ecommerce\ProductCategory;

/** @deprecated временно не смотрим на этот код */
interface ProductCategoryServiceInterface
{
    public function getAll(int $projectId): array;

    public function getOne(int $projectId, int $productCategoryId): ?ProductCategory;

    public function add(ProductCategoryDto $productCategoryDto, int $projectId): ProductCategory;

    public function update(ProductCategoryDto $productCategoryDto, int $projectId, int $productCategoryId): ProductCategory;

    public function remove(int $projectId, int $productCategoryId): bool;
}