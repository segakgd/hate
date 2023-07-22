<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\DealDto;
use App\Entity\Ecommerce\DealEntity;

class DealMapper
{
    public static function mapToDto(DealEntity $dealEntity): DealDto
    {
        return (new DealDto)
            ->setContacts($dealEntity->getContacts())
            ->setFields($dealEntity->getFields())
            ->setOrder($dealEntity->getOrders())
        ;
    }

    public static function mapToEntity(DealDto $dealDto): DealEntity
    {
        return (new DealEntity)
            ->setContacts($dealDto->getContacts())
            ->setFields($dealDto->getFields())
            ->setOrders($dealDto->getOrder())
        ;
    }

    public static function mapToExistDto(DealEntity $dealEntity, DealDto $dealDto): DealDto
    {
        return $dealDto
            ->setContacts($dealEntity->getContacts())
            ->setFields($dealEntity->getFields())
            ->setOrder($dealEntity->getOrders())
        ;
    }

    public static function mapToExistEntity(DealDto $dealDto, DealEntity $dealEntity): DealEntity
    {
        return $dealEntity
            ->setContacts($dealDto->getContacts())
            ->setFields($dealDto->getFields())
            ->setOrders($dealDto->getOrder())
        ;
    }
}
