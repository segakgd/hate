<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\_deprecated\ShippingDto;
use App\Entity\Ecommerce\Shipping;
use App\Repository\Ecommerce\ShippingEntityRepository;
use App\Service\Mapper\Ecommerce\ShippingMapper;
use Psr\Log\LoggerInterface;
use Throwable;

class ShippingService implements ShippingServiceInterface
{
    public function __construct(
        private ShippingEntityRepository $shippingEntityRepository,
        private LoggerInterface $logger,
    ) {
    }

    public function getOne(int $projectId, int $shippingId): ?Shipping
    {
        return $this->shippingEntityRepository->findOneBy(
            [
                'id' => $shippingId,
                'projectId' => $projectId
            ]
        );
    }

    public function getAll(int $projectId): array
    {
        return $this->shippingEntityRepository->findBy(
            [
                'projectId' => $projectId
            ]
        );
    }

    public function add(ShippingDto $shippingDto, int $projectId): Shipping
    {
        $shippingEntity = ShippingMapper::mapToEntity($shippingDto);

        $shippingEntity->setProjectId($projectId);

        $this->shippingEntityRepository->saveAndFlush($shippingEntity);

        return $shippingEntity;
    }

    public function update(ShippingDto $shippingDto, int $projectId, int $shippingId): Shipping
    {
        $shippingEntity = $this->getOne($projectId, $shippingId);

        $shippingEntity = ShippingMapper::mapToExistEntity($shippingDto, $shippingEntity);

        $this->shippingEntityRepository->saveAndFlush($shippingEntity);

        return $shippingEntity;
    }

    public function remove(int $projectId, int $shippingId): bool
    {
        $shippingEntity = $this->getOne($projectId, $shippingId);

        try {
            if ($shippingEntity){
                $this->shippingEntityRepository->removeAndFlush($shippingEntity);
            }

        } catch (Throwable $exception){
            $this->logger->error($exception->getMessage());

            return false;
        }

        return true;
    }
}