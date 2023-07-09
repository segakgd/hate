<?php

namespace App\Entity\Ecommerce;

use App\Repository\DealEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DealEntityRepository::class)]
class DealEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ContactsEntity $Contacts = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?FieldEntity $Fields = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?OrderEntity $Orders = null;

    #[ORM\Column]
    private ?int $project = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContacts(): ?ContactsEntity
    {
        return $this->Contacts;
    }

    public function setContacts(?ContactsEntity $Contacts): static
    {
        $this->Contacts = $Contacts;

        return $this;
    }

    public function getFields(): ?FieldEntity
    {
        return $this->Fields;
    }

    public function setFields(?FieldEntity $Fields): static
    {
        $this->Fields = $Fields;

        return $this;
    }

    public function getOrders(): ?OrderEntity
    {
        return $this->Orders;
    }

    public function setOrders(?OrderEntity $Orders): static
    {
        $this->Orders = $Orders;

        return $this;
    }

    public function getProject(): ?int
    {
        return $this->project;
    }

    public function setProject(int $project): static
    {
        $this->project = $project;

        return $this;
    }
}
