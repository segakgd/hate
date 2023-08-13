<?php

namespace App\Mapper\Ecommerce;

use App\Dto\Ecommerce\ContactsDto;
use App\Entity\Lead\Contacts;

class ContactsMapper
{
    public static function mapToDto(Contacts $contactsEntity): ContactsDto
    {
        return (new ContactsDto)
            ->setFirstName($contactsEntity->getFirstName())
            ->setLastName($contactsEntity->getLastName())
            ->setPhone($contactsEntity->getPhone())
            ->setEmail($contactsEntity->getEmail())
        ;
    }

    public static function mapToEntity(ContactsDto $contactsDto): Contacts
    {
        return (new Contacts)
            ->setFirstName($contactsDto->getFirstName())
            ->setLastName($contactsDto->getLastName())
            ->setPhone($contactsDto->getPhone())
            ->setEmail($contactsDto->getEmail())
        ;
    }

    public static function mapToExistDto(Contacts $contactsEntity, ContactsDto $contactsDto): ContactsDto
    {
        return $contactsDto
            ->setFirstName($contactsEntity->getFirstName())
            ->setLastName($contactsEntity->getLastName())
            ->setPhone($contactsEntity->getPhone())
            ->setEmail($contactsEntity->getEmail())
        ;
    }

    public static function mapToExistEntity(ContactsDto $contactsDto, Contacts $contactsEntity): Contacts
    {
        return $contactsEntity
            ->setFirstName($contactsDto->getFirstName())
            ->setLastName($contactsDto->getLastName())
            ->setPhone($contactsDto->getPhone())
            ->setEmail($contactsDto->getEmail())
        ;
    }
}
