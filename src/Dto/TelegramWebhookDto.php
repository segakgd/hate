<?php

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;

class TelegramWebhookDto
{
    #[SerializedName('update_id')]
    public $updateId;

    public TelegramWebhookMessageDto $message;

    public function getUpdateId()
    {
        return $this->updateId;
    }

    public function setUpdateId($updateId): void
    {
        $this->updateId = $updateId;
    }

    public function getMessage(): TelegramWebhookMessageDto
    {
        return $this->message;
    }

    public function setMessage(TelegramWebhookMessageDto $message): void
    {
        $this->message = $message;
    }
}