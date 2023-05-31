<?php

namespace App\Service\Handler;

use App\Dto\Message\MessageDto;
use App\Service\TelegramService;

class MessageHandler
{
    public function __construct(
        private readonly TelegramService $telegramService,
    ) {
    }

    public function handle($action): bool
    {
        if ('message' === $action->getType()) {
            $messageDto = (new MessageDto())
                ->setChatId($action->getChatId())
                ->setText($action->getContent())
            ;

            $this->telegramService->sendMessage($messageDto, '5109953245:AAE7TIhplLRxJdGmM27YSeSIdJdOh4ZXVVY');

            return true;
        }

        return false;
    }
}