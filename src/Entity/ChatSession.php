<?php

namespace App\Entity;

use App\Repository\ChatSessionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatSessionRepository::class)]
class ChatSession // todo по сути это visitor
{
    // todo требуется добавить userId

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $chatId;

    #[ORM\Column(length: 20)]
    private string $channel;

    #[ORM\Column(nullable: true)]
    private ?int $chatEvent = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getChatId(): int
    {
        return $this->chatId;
    }

    public function setChatId(int $chatId): self
    {
        $this->chatId = $chatId;

        return $this;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function getChatEvent(): ?int
    {
        return $this->chatEvent;
    }

    public function setChatEvent(?int $chatEvent): self
    {
        $this->chatEvent = $chatEvent;

        return $this;
    }
}
