<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\DealDto;
use App\Entity\Ecommerce\DealEntity;
use App\Mapper\Ecommerce\DealMapper;
use App\Repository\DealEntityRepository;
use Psr\Log\LoggerInterface;
use Throwable;

class DealService implements DealServiceInterface
{
    public function __construct(
        private readonly DealEntityRepository $dealEntityRepository,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function getAll(int $projectId): array
    {
        return $this->dealEntityRepository->findBy(
            [
                'project' => $projectId
            ]
        );
    }

    public function getOne(int $projectId, int $dealId): ?DealEntity
    {
        return $this->dealEntityRepository->findOneBy(
            [
                'id' => $dealId,
                'project' => $projectId
            ]
        );
    }

    public function add(DealDto $dealDto, int $projectId): DealEntity
    {
        $dealEntity = DealMapper::mapToEntity($dealDto);

        $dealEntity->setProject($projectId);

        $this->dealEntityRepository->saveAndFlush($dealEntity);

        return $dealEntity;
    }

    public function update(DealDto $dealDto, int $projectId, int $dealId): DealEntity
    {
        $dealEntity = $this->getOne($projectId, $dealId);

        $dealEntity = DealMapper::mapToExistEntity($dealDto, $dealEntity);

        $this->dealEntityRepository->saveAndFlush($dealEntity);

        return $dealEntity;
    }

    public function remove(int $projectId, int $dealId): bool
    {
        $deal = $this->getOne($projectId, $dealId);

        try {
            if ($deal){
                $this->dealEntityRepository->removeAndFlush($deal);
            }

        } catch (Throwable $exception){
            $this->logger->error($exception->getMessage());

            return false;
        }

        return true;
    }
}