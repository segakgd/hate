<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\ProductDto;
use App\Entity\Ecommerce\ProductEntity;
use App\Mapper\Ecommerce\ProductMapper;
use App\Repository\ProductEntityRepository;
use Psr\Log\LoggerInterface;
use Throwable;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        private readonly ProductEntityRepository $productEntityRepository,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function getProducts(int $projectId): array
    {
        return $this->productEntityRepository->findBy(
            [
                'project' => $projectId
            ]
        );
    }

    public function getProduct(int $projectId, int $productId): ?ProductEntity
    {
        return $this->productEntityRepository->findOneBy(
            [
                'id' => $productId,
                'project' => $projectId
            ]
        );
    }

    public function addProduct(ProductDto $productDto, int $projectId): ProductEntity
    {
        $productEntity = ProductMapper::mapToEntity($productDto);

        $productEntity->setProject($projectId);

        $this->productEntityRepository->saveAndFlush($productEntity);

        return $productEntity;
    }

    public function updateProduct(ProductDto $productDto, int $projectId, int $productId): ProductEntity
    {
        $productEntity = $this->getProduct($projectId, $productId);

        $productEntity = ProductMapper::mapToExistEntity($productDto, $productEntity);

        $this->productEntityRepository->saveAndFlush($productEntity);

        return $productEntity;
    }

    public function removeProduct(int $projectId, int $productId): bool
    {
        $productEntity = $this->getProduct($projectId, $productId);

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
}