<?php

namespace App\Entity;

use App\Repository\BehaviorScenarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BehaviorScenarioRepository::class)]
class BehaviorScenario
{
    // todo требуется добавить userId

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private array $content = [];

    #[ORM\Column(nullable: true)]
    private ?int $ownerStepId = null;

    #[ORM\Column(nullable: true)]
    private ?array $actionAfter = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOwnerStepId(): ?int
    {
        return $this->ownerStepId;
    }

    public function setOwnerStepId(int $ownerStepId): self
    {
        $this->ownerStepId = $ownerStepId;

        return $this;
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function setContent(array $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getActionAfter(): array
    {
        return $this->actionAfter;
    }

    public function setActionAfter(?array $actionAfter): self
    {
        $this->actionAfter = $actionAfter;

        return $this;
    }
}
