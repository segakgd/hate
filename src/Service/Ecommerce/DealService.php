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

    public function getDeals(int $projectId): array // с пагинацией
    {
        return $this->dealEntityRepository->findBy(
            [
                'project' => $projectId
            ]
        );
    }

    public function getDeal(int $dealId): ?DealEntity
    {
        return $this->dealEntityRepository->find($dealId);
    }

    public function addDeal(int $projectId, DealDto $dealDto): DealEntity
    {
        $dealEntity = DealMapper::mapToEntity($dealDto);

        $dealEntity->setProject($projectId);

        $this->dealEntityRepository->saveAndFlush($dealEntity);

        return $dealEntity;
    }

    public function updateDeal(DealDto $dealDto, int $dealId): DealEntity
    {
        $dealEntity = $this->getDeal($dealId);

        $dealEntity = DealMapper::mapToExistEntity($dealDto, $dealEntity);

        $this->dealEntityRepository->saveAndFlush($dealEntity);

        return $dealEntity;
    }

    public function removeDeal(int $dealId): bool
    {
        $deal = $this->getDeal($dealId);

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