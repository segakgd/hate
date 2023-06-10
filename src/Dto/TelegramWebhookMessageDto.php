<?php

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;

class TelegramWebhookMessageDto
{
    #[SerializedName('message_id')]
    public $messageId;

    public $from;

    public $chat;

    public $date;

    public $text;

    public $entities;

    public function getMessageId()
    {
        return $this->messageId;
    }

    public function setMessageId($messageId): void
    {
        $this->messageId = $messageId;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from): void
    {
        $this->from = $from;
    }

    public function getChat()
    {
        return $this->chat;
    }

    public function setChat($chat): void
    {
        $this->chat = $chat;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text): void
    {
        $this->text = $text;
    }

    public function getEntities()
    {
        return $this->entities;
    }

    public function setEntities($entities): void
    {
        $this->entities = $entities;
    }

    public function isCommand(): bool
    {
        $entities = $this->getEntities();

        return isset($entities[0]['type']) && $entities[0]['type'] === 'bot_command';
    }

    public function isMessage(): bool
    {
        return $this->getText() !== null;
    }
}