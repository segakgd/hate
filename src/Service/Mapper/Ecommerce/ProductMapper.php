<?php

namespace App\Service\Mapper\Ecommerce;

use App\Dto\Ecommerce\ProductDto;
use App\Entity\Ecommerce\Product;

class ProductMapper
{
    public static function mapToDto(Product $entity): ProductDto
    {
        return self::mapToExistDto($entity, (new ProductDto));
    }

    public static function mapToEntity(ProductDto $dto): Product
    {
        return self::mapToExistEntity($dto, (new Product));
    }

    public static function mapToExistDto(Product $entity, ProductDto $dto): ProductDto
    {
        if ($categories = $entity->getCategories()){
            foreach ($categories as $category){
                $dto->addCategory(ProductCategoryMapper::mapToDto($category));
            }
        }

        if ($variants = $entity->getVariants()){
            foreach ($variants as $variant){
                $dto->addVariant(ProductVariantMapper::mapToDto($variant));
            }
        }

        return $dto
            ->setId($entity->getId())
            ->setProjectId($entity->getProjectId())
            ->setCreatedAt($entity->getCreatedAt())
            ->setUpdatedAt($entity->getUpdatedAt())
        ;
    }

    public static function mapToExistEntity(ProductDto $dto, Product $entity): Product
    {
        if ($projectId = $dto->getProjectId()){
            $entity->setProjectId($projectId);
        }

        if ($categoriesDto = $dto->getCategories()){
            $categoriesEntity = $entity->getCategories();

            if ($categoriesEntity->count() > 0){
                foreach ($categoriesDto as $categoryDto){
                    $isUpdated = false;

                    foreach ($categoriesEntity as $categoryEntity){
                        if ($categoryDto->getId() === $categoryEntity->getId()){
                            $entity->addCategory(ProductCategoryMapper::mapToExistEntity($categoryDto, $categoryEntity));

                            $isUpdated = true;
                        }
                    }

                    if (!$isUpdated){
                        $entity->addCategory(ProductCategoryMapper::mapToEntity($categoryDto));
                    }
                }

            } else {
                foreach ($categoriesDto as $categoryDto){
                    $entity->addCategory(ProductCategoryMapper::mapToEntity($categoryDto));
                }
            }
        }

        if ($variantsDto = $dto->getVariants()){
            if ($variantsEntity = $entity->getVariants()){
                foreach ($variantsDto as $variantDto){
                    $isUpdated = false;

                    foreach ($variantsEntity as $variantEntity){
                        if ($variantDto->getId() === $variantEntity->getId()){
                            $entity->addVariant(ProductVariantMapper::mapToExistEntity($variantDto, $variantEntity));

                            $isUpdated = true;
                        }
                    }

                    if (!$isUpdated){
                        $entity->addVariant(ProductVariantMapper::mapToEntity($variantDto));
                    }
                }
            } else {
                foreach ($variantsDto as $variantDto){
                    $entity->addVariant(ProductVariantMapper::mapToEntity($variantDto));
                }
            }
        }

        return $entity;
    }
}
