<?php

namespace App\Service\Ecommerce\Field;

use App\Dto\Ecommerce\FieldDto;
use App\Entity\Lead\DealField;
use App\Repository\Lead\FieldEntityRepository;

class FieldService
{

    public function __construct(
        private FieldEntityRepository $fieldEntityRepository,
    ) {
    }

    public function add(FieldDto $dto): DealField
    {
        $entity = (new DealField());

        $entity
            ->setValue($dto->getValue())
            ->setName($dto->getName())
        ;

        $this->fieldEntityRepository->saveAndFlush($entity);

        return $entity;
    }

    public function update(FieldDto $dto): ?DealField
    {
        $entity = $this->fieldEntityRepository->find($dto->getId());

        if (!$entity){
            $entity = (new DealField());
        }

        $entity
            ->setValue($dto->getValue())
            ->setName($dto->getName())
        ;

        $this->fieldEntityRepository->saveAndFlush($entity);

        return $entity;
    }
}
