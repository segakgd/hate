<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\ContactsDto;
use App\Entity\Ecommerce\ContactsEntity;

class ContactsMapper
{
    public static function mapToDto(ContactsEntity $contactsEntity): ContactsDto
    {
        return (new ContactsDto)
            ->setFirstName($contactsEntity->getFirstName())
            ->setLastName($contactsEntity->getLastName())
            ->setPhone($contactsEntity->getPhone())
            ->setEmail($contactsEntity->getEmail())
        ;
    }

    public static function mapToEntity(ContactsDto $contactsDto): ContactsEntity
    {
        return (new ContactsEntity)
            ->setFirstName($contactsDto->getFirstName())
            ->setLastName($contactsDto->getLastName())
            ->setPhone($contactsDto->getPhone())
            ->setEmail($contactsDto->getEmail())
        ;
    }

    public static function mapToExistDto(ContactsEntity $contactsEntity, ContactsDto $contactsDto): ContactsDto
    {
        return $contactsDto
            ->setFirstName($contactsEntity->getFirstName())
            ->setLastName($contactsEntity->getLastName())
            ->setPhone($contactsEntity->getPhone())
            ->setEmail($contactsEntity->getEmail())
        ;
    }

    public static function mapToExistEntity(ContactsDto $contactsDto, ContactsEntity $contactsEntity): ContactsEntity
    {
        return $contactsEntity
            ->setFirstName($contactsDto->getFirstName())
            ->setLastName($contactsDto->getLastName())
            ->setPhone($contactsDto->getPhone())
            ->setEmail($contactsDto->getEmail())
        ;
    }
}