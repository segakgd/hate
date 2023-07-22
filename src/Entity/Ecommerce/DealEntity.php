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
    private ?ContactsEntity $contacts = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?FieldEntity $fields = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?OrderEntity $orders = null;

    #[ORM\Column]
    private ?int $project = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContacts(): ?ContactsEntity
    {
        return $this->contacts;
    }

    public function setContacts(?ContactsEntity $contacts): static
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function getFields(): ?FieldEntity
    {
        return $this->fields;
    }

    public function setFields(?FieldEntity $fields): static
    {
        $this->fields = $fields;

        return $this;
    }

    public function getOrders(): ?OrderEntity
    {
        return $this->orders;
    }

    public function setOrders(?OrderEntity $orders): static
    {
        $this->orders = $orders;

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
