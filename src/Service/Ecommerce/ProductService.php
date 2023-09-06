<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ProductDto;
use App\Entity\Ecommerce\ProductCategory;
use App\Entity\Ecommerce\Product;
use App\Mapper\Ecommerce\ProductMapper;
use App\Repository\Ecommerce\ProductCategoryEntityRepository;
use App\Repository\Ecommerce\ProductEntityRepository;
use Psr\Log\LoggerInterface;
use Throwable;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        private ProductEntityRepository $productEntityRepository,
        private ProductCategoryEntityRepository $productCategoryEntityRepository,
        private LoggerInterface $logger,
    ) {
    }

    public function getAll(int $projectId): array
    {
        return $this->productEntityRepository->findBy(
            [
                'project' => $projectId
            ]
        );
    }

    public function getOne(int $projectId, int $productId): ?Product
    {
        return $this->productEntityRepository->findOneBy(
            [
                'id' => $productId,
                'project' => $projectId
            ]
        );
    }

    public function add(ProductDto $productDto, int $projectId): Product
    {
        $productEntity = ProductMapper::mapToEntity($productDto);

        dd($productEntity);

        $productEntity->setProjectId($projectId);

        $this->productEntityRepository->saveAndFlush($productEntity);

        return $productEntity;
    }

    public function update(ProductDto $productDto, int $projectId, int $productId): Product
    {
        $productEntity = $this->getOne($projectId, $productId);

        $productEntity = ProductMapper::mapToExistEntity($productDto, $productEntity);

        $this->productEntityRepository->saveAndFlush($productEntity);

        return $productEntity;
    }

    public function remove(int $projectId, int $productId): bool
    {
        $productEntity = $this->getOne($projectId, $productId);

        try {
            if ($productEntity){
                $this->productEntityRepository->removeAndFlush($productEntity);
            }

        } catch (Throwable $exception){
            $this->logger->error($exception->getMessage());

            return false;
        }

        return true;
    }

    public function addInCategory(Product $product, ProductCategory $productCategory): ProductCategory
    {
        $productCategory->addProduct($product);

        $this->productCategoryEntityRepository->saveAndFlush($productCategory);

        return $productCategory;
    }

    public function isExist(int $id): bool
    {
        return (bool) $this->productEntityRepository->find($id);
    }
}