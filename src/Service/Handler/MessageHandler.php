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
            $actionContent = $action->getContent();

            $messageDto = (new MessageDto())
                ->setChatId($action->getChatId())
                ->setText($actionContent['message'])
            ;

            if(!empty($actionContent['replyMarkup'])){
                $messageDto->setReplyMarkup($actionContent['replyMarkup']);
            }

            $this->telegramService->sendMessage($messageDto, '5109953245:AAE7TIhplLRxJdGmM27YSeSIdJdOh4ZXVVY');

            return true;
        }

        return false;
    }
}