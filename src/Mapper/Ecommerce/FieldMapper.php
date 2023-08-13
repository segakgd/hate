<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\FieldDto;
use App\Entity\Lead\Field;

class FieldMapper
{
    public static function mapToDto(Field $fieldEntity): FieldDto
    {
        return (new FieldDto)
            ->setValue($fieldEntity->getValue())
            ->setName($fieldEntity->getName())
            ;
    }

    public static function mapToEntity(FieldDto $fieldDto): Field
    {

        return (new Field)
            ->setValue($fieldDto->getValue())
            ->setName($fieldDto->getName())
            ;
    }

    public static function mapToExistDto(Field $fieldEntity, FieldDto $fieldDto): FieldDto
    {
        return $fieldDto
            ->setValue($fieldEntity->getValue())
            ->setName($fieldEntity->getName())
            ;
    }

    public static function mapToExistEntity(FieldDto $fieldDto, Field $fieldEntity): Field
    {
        return $fieldEntity
            ->setValue($fieldDto->getValue())
            ->setName($fieldDto->getName())
            ;
    }
}
