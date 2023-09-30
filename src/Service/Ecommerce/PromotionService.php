<?php

namespace App\Service\Ecommerce;

use App\Dto\Ecommerce\_deprecated\PromotionDto;
use App\Entity\Ecommerce\Promotion;
use App\Repository\Ecommerce\PromotionEntityRepository;
use App\Service\Mapper\Ecommerce\PromotionMapper;
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
                'projectId' => $projectId
            ]
        );
    }

    public function getAll(int $projectId): array
    {
        return $this->promotionEntityRepository->findBy(
            [
                'projectId' => $projectId
            ]
        );
    }

    public function add(PromotionDto $promotionDto, int $projectId): Promotion
    {
        $entity = (new Promotion());

        if ($name = $promotionDto->getName()){
            $entity->setName($name);
        }

        if ($type = $promotionDto->getType()){
            $entity->setType($type);
        }

        if ($price = $promotionDto->getPrice()){
            $entity->setPrice($price->toArray());
        }

        if ($active = $promotionDto->getActive()){
            $entity->setActive($active);
        }

        if ($code = $promotionDto->getCode()){
            $entity->setCode($code);
        }

        if ($count = $promotionDto->getCount()){
            $entity->setCount($count);
        }

        $entity->setProjectId($projectId);

        $this->promotionEntityRepository->saveAndFlush($entity);

        return $entity;
    }

    public function update(PromotionDto $promotionDto, int $projectId, int $promotionId): Promotion
    {
        $entity = $this->getOne($projectId, $promotionId);

        if ($name = $promotionDto->getName()){
            $entity->setName($name);
        }

        if ($type = $promotionDto->getType()){
            $entity->setType($type);
        }

        if ($price = $promotionDto->getPrice()){
            $entity->setPrice($price->toArray());
        }

        if ($active = $promotionDto->getActive()){
            $entity->setActive($active);
        }

        if ($code = $promotionDto->getCode()){
            $entity->setCode($code);
        }

        if ($count = $promotionDto->getCount()){
            $entity->setCount($count);
        }

        $this->promotionEntityRepository->saveAndFlush($entity);

        return $entity;
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