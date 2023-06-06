<?php

namespace App\Entity;

use App\Repository\ChatEventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatEventRepository::class)]
class ChatEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $behaviorScenario = null;

    #[ORM\Column(nullable: true)]
    private array $actionBefore = [];

    #[ORM\Column(nullable: true)]
    private array $actionAfter = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getBehaviorScenario(): ?int
    {
        return $this->behaviorScenario;
    }

    public function setBehaviorScenario(int $behaviorScenario): self
    {
        $this->behaviorScenario = $behaviorScenario;

        return $this;
    }

    public function getActionBefore(): array
    {
        return $this->actionBefore;
    }

    public function setActionBefore(?array $actionBefore): self
    {
        $this->actionBefore = $actionBefore;

        return $this;
    }

    public function getActionAfter(): ?array
    {
        return $this->actionAfter;
    }

    public function setActionAfter(?array $actionAfter): self
    {
        $this->actionAfter = $actionAfter;

        return $this;
    }
}
