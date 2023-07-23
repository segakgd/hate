<?php

namespace App\Entity\Ecommerce;

use App\Repository\DealEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DealEntityRepository::class)]
class DealEntity
{
    #[Groups(['administrator'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['administrator'])]
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ContactsEntity $contacts = null;

    #[Groups(['administrator'])]
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?FieldEntity $fields = null;

    #[Groups(['administrator'])]
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

    public function setFields(?FieldEntity $fields): static // todo setField!!!
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
