<?php

namespace App\Entity\Ecommerce;

use App\Repository\FieldEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FieldEntityRepository::class)]
class FieldEntity // todo deal_field
{
    #[Groups(['administrator'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['administrator'])]
    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[Groups(['administrator'])]
    #[ORM\Column(length: 50)]
    private ?string $value = null;

    #[ORM\ManyToOne(inversedBy: 'fields')]
    private ?DealEntity $deal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getDeal(): ?DealEntity
    {
        return $this->deal;
    }

    public function setDeal(?DealEntity $deal): static
    {
        $this->deal = $deal;

        return $this;
    }
}
