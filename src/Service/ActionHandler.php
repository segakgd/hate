<?php

namespace App\Service;

use App\Entity\ChatEvent;
use App\Service\Handler\CommandHandler;
use App\Service\Handler\MessageHandler;

class ActionHandler
{
    public function __construct(
        private readonly CommandHandler $commandHandler,
        private readonly MessageHandler $messageHandler,
    ) {
    }

    public function handle(ChatEvent $chatEvent): bool
    {
        return match ($chatEvent->getType()) {
            'command' => $this->commandHandler->handle($chatEvent) ?? true, // ?? true todo временное решение
            'message' => $this->messageHandler->handle($chatEvent) ?? true, // ?? true todo временное решение
            default => false
        };
    }
}