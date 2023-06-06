<?php

namespace App\Service;

use App\Entity\ChatEvent;
use App\Service\Handler\MessageHandler;

class ActionHandler
{
    public function __construct(
        private readonly MessageHandler $messageHandler,
    ) {
    }

    public function handle(ChatEvent $action): bool
    {
        return match ($action->getType()) {
            'message' => $this->messageHandler->handle($action),
            default => false
        };
    }
}