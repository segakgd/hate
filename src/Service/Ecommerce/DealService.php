<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\DealDto;
use App\Entity\Lead\Deal;
use App\Repository\Lead\DealEntityRepository;
use App\Service\Mapper\Ecommerce\DealMapper;
use Psr\Log\LoggerInterface;
use Throwable;

class DealService implements DealServiceInterface
{
    public function __construct(
        private DealEntityRepository $dealEntityRepository,
        private LoggerInterface $logger,
    ) {
    }

    public function getAll(int $projectId): array
    {
        return $this->dealEntityRepository->findBy(
            [
                'projectId' => $projectId
            ]
        );
    }

    public function getOne(int $projectId, int $dealId): ?Deal
    {
        return $this->dealEntityRepository->findOneBy(
            [
                'id' => $dealId,
                'projectId' => $projectId
            ]
        );
    }

    public function add(DealDto $dealDto, int $projectId): Deal
    {
        $dealEntity = DealMapper::mapToEntity($dealDto);

        $dealEntity->setProjectId($projectId);

        $this->dealEntityRepository->saveAndFlush($dealEntity);

        return $dealEntity;
    }

    public function update(DealDto $dealDto, int $projectId, int $dealId): Deal
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