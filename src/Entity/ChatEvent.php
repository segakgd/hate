<?php

namespace App\Entity;

use App\Repository\ChatEventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatEventRepository::class)]
class ChatEvent
{
    public const STATUS_IN_PROCESS = 'in_process';

    public const STATUS_NEW = 'new';

    public const WAITING_ACTION = 'waiting_action';

    public const STATUS_DONE = 'done';

    public const STATUS_FAIL = 'fail';

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

    #[ORM\Column(length: 15)]
    private string $status = self::STATUS_NEW;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self // todo откуда сеттер? хм..
    {
        $this->id = $id;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function issetActions(): bool
    {
        return $this->actionAfter || $this->actionBefore;
    }
}
