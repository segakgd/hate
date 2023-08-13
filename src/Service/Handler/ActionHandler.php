<?php

namespace App\Service\Handler;

use App\Entity\Visitor\VisitorEvent;
use App\Service\Handler\Items\CommandHandler;
use App\Service\Handler\Items\MessageHandler;

class ActionHandler
{
    public function __construct(
        private readonly CommandHandler $commandHandler,
        private readonly MessageHandler $messageHandler,
    ) {
    }

    public function handle(VisitorEvent $chatEvent): bool
    {
        return match ($chatEvent->getType()) {
            'command' => $this->commandHandler->handle($chatEvent) ?? true, // ?? true todo временное решение
            'message' => $this->messageHandler->handle($chatEvent) ?? true, // ?? true todo временное решение
            default => false
        };
    }
}