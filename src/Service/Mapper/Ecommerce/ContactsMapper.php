<?php

namespace App\Service\Mapper\Ecommerce;

use App\Dto\Ecommerce\ContactsDto;
use App\Entity\Lead\Contacts;

class ContactsMapper
{
    public static function mapToDto(Contacts $entity): ContactsDto
    {
        return self::mapToExistDto($entity, (new ContactsDto));
    }

    public static function mapToEntity(ContactsDto $dto): Contacts
    {
        return self::mapToExistEntity($dto, (new Contacts));
    }

    public static function mapToExistDto(Contacts $entity, ContactsDto $dto): ContactsDto
    {
        return $dto
            ->setFirstName($entity->getFirstName())
            ->setLastName($entity->getLastName())
            ->setPhone($entity->getPhone())
            ->setEmail($entity->getEmail())
        ;
    }

    public static function mapToExistEntity(ContactsDto $dto, Contacts $entity): Contacts
    {
        return $entity
            ->setFirstName($dto->getFirstName())
            ->setLastName($dto->getLastName())
            ->setPhone($dto->getPhone())
            ->setEmail($dto->getEmail())
        ;
    }
}
