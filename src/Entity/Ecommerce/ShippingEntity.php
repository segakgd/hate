<?php

namespace App\Entity\Ecommerce;

use App\Repository\Ecommerce\ShippingEntityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/** @deprecated временно не смотрим на этот код */
#[ORM\Entity(repositoryClass: ShippingEntityRepository::class)]
class ShippingEntity
{
    #[Groups(['administrator'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['administrator'])]
    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[Groups(['administrator'])]
    #[ORM\Column(length: 20)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $project = null;

    #[Groups(['administrator'])]
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private array $price = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

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

    public function getPrice(): array
    {
        return $this->price;
    }

    public function setPrice(?array $price): static
    {
        $this->price = $price;

        return $this;
    }
}
