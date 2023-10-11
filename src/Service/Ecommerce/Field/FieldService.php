<?php

namespace App\Service\Ecommerce\Field;

use App\Dto\Ecommerce\FieldDto;
use App\Entity\Lead\Field;
use App\Repository\Lead\FieldEntityRepository;

class FieldService
{

    public function __construct(
        private FieldEntityRepository $fieldEntityRepository,
    ) {
    }

    public function add(FieldDto $dto): Field
    {
        $entity = (new Field());

        $entity
            ->setValue($dto->getValue())
            ->setName($dto->getName())
        ;

        $this->fieldEntityRepository->saveAndFlush($entity);

        return $entity;
    }

    public function update(FieldDto $dto): ?Field
    {
        $entity = $this->fieldEntityRepository->find($dto->getId());

        if (!$entity){
            $entity = (new Field());
        }

        $entity
            ->setValue($dto->getValue())
            ->setName($dto->getName())
        ;

        $this->fieldEntityRepository->saveAndFlush($entity);

        return $entity;
    }
}
