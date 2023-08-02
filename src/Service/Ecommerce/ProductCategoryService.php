<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ProductCategoryDto;
use App\Entity\Ecommerce\ProductCategoryEntity;
use App\Mapper\Ecommerce\ProductCategoryMapper;
use App\Repository\Ecommerce\ProductCategoryEntityRepository;
use Psr\Log\LoggerInterface;
use Throwable;

class ProductCategoryService implements ProductCategoryServiceInterface
{
    public function __construct(
        private readonly ProductCategoryEntityRepository $productCategoryEntityRepository,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function getAll(int $projectId): array
    {
        return $this->productCategoryEntityRepository->findBy(
            [
                'project' => $projectId
            ]
        );
    }

    public function getOne(int $projectId, int $productCategoryId): ?ProductCategoryEntity
    {
        return $this->productCategoryEntityRepository->findOneBy(
            [
                'id' => $productCategoryId,
                'project' => $projectId
            ]
        );
    }

    public function add(ProductCategoryDto $productCategoryDto, int $projectId): ProductCategoryEntity
    {
        $productCategory = ProductCategoryMapper::mapToEntity($productCategoryDto);

        $productCategory->setProject($projectId);

        $this->productCategoryEntityRepository->saveAndFlush($productCategory);

        return $productCategory;
    }

    public function update(ProductCategoryDto $productCategoryDto, int $projectId, int $productCategoryId): ProductCategoryEntity
    {
        $productCategory = $this->getOne($projectId, $productCategoryId);

        $productCategory = ProductCategoryMapper::mapToExistEntity($productCategoryDto, $productCategory);

        $this->productCategoryEntityRepository->saveAndFlush($productCategory);

        return $productCategory;
    }

    public function remove(int $projectId, int $productCategoryId): bool
    {
        $productCategory = $this->getOne($projectId, $productCategoryId);

        try {
            if ($productCategory){
                $this->productCategoryEntityRepository->removeAndFlush($productCategory);
            }

        } catch (Throwable $exception){
            $this->logger->error($exception->getMessage());

            return false;
        }

        return true;
    }
}
