<?php

namespace App\Service\Ecommerce\Contact;

use App\Dto\Ecommerce\ContactsDto;
use App\Entity\Lead\Contacts;
use App\Repository\Lead\ContactsEntityRepository;
use DateTimeImmutable;

class ContactService
{
    public function __construct(
        private ContactsEntityRepository $contactsEntityRepository,
    ) {
    }

    public function add(ContactsDto $dto): Contacts
    {
        $entity = (new Contacts());

        $entity
            ->setFirstName($dto->getFirstName())
            ->setLastName($dto->getLastName())
            ->setPhone($dto->getPhone())
            ->setEmail($dto->getEmail())
            ->setCreatedAt(new DateTimeImmutable())
        ;

        $this->contactsEntityRepository->saveAndFlush($entity);

        return $entity;
    }

    public function update(ContactsDto $dto): ?Contacts
    {
        $entity = $this->contactsEntityRepository->find($dto->getId());

        if (!$entity){
            $entity = (new Contacts());
        }

        $entity
            ->setFirstName($dto->getFirstName())
            ->setLastName($dto->getLastName())
            ->setPhone($dto->getPhone())
            ->setEmail($dto->getEmail())
        ;

        $this->contactsEntityRepository->saveAndFlush($entity);

        return $entity;
    }
}