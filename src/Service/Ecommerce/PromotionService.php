<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\_deprecated\PromotionDto;
use App\Entity\Ecommerce\Promotion;
use App\Mapper\Ecommerce\PromotionMapper;
use App\Repository\Ecommerce\PromotionEntityRepository;
use Psr\Log\LoggerInterface;
use Throwable;

class PromotionService implements PromotionServiceInterface
{
    public function __construct(
        private PromotionEntityRepository $promotionEntityRepository,
        private LoggerInterface $logger,
    ) {
    }

    public function getOne(int $projectId, int $promotionId): ?Promotion
    {
        return $this->promotionEntityRepository->findOneBy(
            [
                'id' => $promotionId,
                'project' => $projectId
            ]
        );
    }

    public function getAll(int $projectId): array
    {
        return $this->promotionEntityRepository->findBy(
            [
                'project' => $projectId
            ]
        );
    }

    public function add(PromotionDto $promotionDto, int $projectId): Promotion
    {
        $promotionEntity = PromotionMapper::mapToEntity($promotionDto);

        $promotionEntity->setProject($projectId);

        $this->promotionEntityRepository->saveAndFlush($promotionEntity);

        return $promotionEntity;
    }

    public function update(PromotionDto $promotionDto, int $projectId, int $promotionId): Promotion
    {
        $promotionEntity = $this->getOne($projectId, $promotionId);

        $promotionEntity = PromotionMapper::mapToExistEntity($promotionDto, $promotionEntity);

        $this->promotionEntityRepository->saveAndFlush($promotionEntity);

        return $promotionEntity;
    }

    public function remove(int $projectId, int $promotionId): bool
    {
        $promotionEntity = $this->getOne($projectId, $promotionId);

        try {
            if ($promotionEntity){
                $this->promotionEntityRepository->removeAndFlush($promotionEntity);
            }

        } catch (Throwable $exception){
            $this->logger->error($exception->getMessage());

            return false;
        }

        return true;
    }
}