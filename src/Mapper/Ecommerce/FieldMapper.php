<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\FieldDto;
use App\Entity\Lead\Field;

class FieldMapper
{
    public static function mapToDto(Field $entity): FieldDto
    {
        return self::mapToExistDto($entity, (new FieldDto));
    }

    public static function mapToEntity(FieldDto $dto): Field
    {

        return (new Field)
            ->setValue($dto->getValue())
            ->setName($dto->getName())
            ;
    }

    public static function mapToExistDto(Field $entity, FieldDto $dto): FieldDto
    {
        return $dto
            ->setValue($entity->getValue())
            ->setName($entity->getName())
            ;
    }

    public static function mapToExistEntity(FieldDto $dto, Field $entity): Field
    {
        return $entity
            ->setValue($dto->getValue())
            ->setName($dto->getName())
            ;
    }
}
