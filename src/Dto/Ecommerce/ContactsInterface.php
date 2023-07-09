<?php

namespace App\Dto\Ecommerce;

interface ContactsInterface
{
    public function getFirstName(): ?string;

    public function setFirstName(string $firstName): static;

    public function getLastName(): ?string;

    public function setLastName(?string $lastName): static;

    public function getPhone(): ?string;

    public function setPhone(?string $phone): static;

    public function getEmail(): ?string;

    public function setEmail(?string $email): static;
}
