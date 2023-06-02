<?php

namespace App\Service\Webhook;

use App\Service\Webhook\Telegram\TelegramActionDecode;
use Exception;

class ActionDecodeHandler
{
    public function __construct(
        private readonly TelegramActionDecode $telegramActionDecode,
    ) {
    }

    /**
     * @throws Exception
     */
    public function findAndDecodeActionByTypeWebhook(string $type, array $webhookData): ?array
    {
        return match ($type){
            'telegram' => $this->telegramActionDecode->getType($webhookData)
        };
    }
}