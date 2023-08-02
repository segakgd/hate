<?php

namespace App\Entity\Ecommerce;

use App\Repository\Ecommerce\PromotionEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/** @deprecated временно не смотрим на этот код */
#[ORM\Entity(repositoryClass: PromotionEntityRepository::class)]
class PromotionEntity
{
    #[Groups(['administrator'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['administrator'])]
    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[Groups(['administrator'])]
    #[ORM\Column]
    private array $price = [];

    #[ORM\Column]
    private ?int $project = null;

    #[Groups(['administrator'])]
    #[ORM\Column(length: 20)]
    private ?string $type = null;

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

    public function getPrice(): array
    {
        return $this->price;
    }

    public function setPrice(array $price): static
    {
        $this->price = $price;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
