<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\FieldDto;
use App\Entity\Ecommerce\FieldEntity;

class FieldMapper
{
    public static function mapToDto(FieldEntity $fieldEntity): FieldDto
    {
        return (new FieldDto)
            ->setValue($fieldEntity->getValue())
            ->setName($fieldEntity->getName())
            ;
    }

    public static function mapToEntity(FieldDto $fieldDto): FieldEntity
    {
        return (new FieldEntity)
            ->setValue($fieldDto->getValue())
            ->setName($fieldDto->getName())
            ;
    }

    public static function mapToExistDto(FieldEntity $fieldEntity, FieldDto $fieldDto): FieldDto
    {
        return $fieldDto
            ->setValue($fieldEntity->getValue())
            ->setName($fieldEntity->getName())
            ;
    }

    public static function mapToExistEntity(FieldDto $fieldDto, FieldEntity $fieldEntity): FieldEntity
    {
        return $fieldEntity
            ->setValue($fieldDto->getValue())
            ->setName($fieldDto->getName())
            ;
    }
}
