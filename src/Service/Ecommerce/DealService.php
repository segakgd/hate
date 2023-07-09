<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\DealDto;
use App\Entity\Ecommerce\DealEntity;
use App\Repository\DealEntityRepository;
use Psr\Log\LoggerInterface;
use Throwable;

class DealService
{
    public function __construct(
        private DealEntityRepository $dealEntityRepository,
        private LoggerInterface $logger,
    ) {
    }

    public function getDeals(int $projectId): array // с пагинацией
    {
        $this->dealEntityRepository->findBy(
            [
                'project' => $projectId
            ]
        );

        return [];
    }

    public function getDeal(int $dealId): ?DealEntity
    {
        return $this->dealEntityRepository->find($dealId);
    }

    public function addDeal(DealDto $projectId, DealDto $dealDto): DealEntity
    {
        return new DealEntity;
    }

    public function updateDeal(DealDto $dealDto): DealEntity
    {
        return new DealEntity;
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