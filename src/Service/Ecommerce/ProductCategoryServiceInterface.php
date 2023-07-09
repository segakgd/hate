<?php

namespace App\Service\Ecommerce;

interface ProductCategoryServiceInterface
{
    public function getCategories(): array;

    public function getCategory(int $categoryId); //: CategoryEntity;

    public function addCategory( $categoryDto); //: CategoryEntity;

    public function updateCategory($categoryDto); //: CategoryEntity;

    public function removeCategory(int $categoryId);//: CategoryEntity;
}