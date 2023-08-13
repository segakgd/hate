<?php

namespace App\Service;

use App\Entity\ChatSession;
use App\Repository\ChatSessionRepository;

class ChatSessionService
{
    public function __construct(
        private readonly ChatSessionRepository $chatSessionRepository,
    ) {
    }

    public function getOrCreateChatSession(int $chatId, string $channel): ?ChatSession
    {
        $chatSession = $this->chatSessionRepository->getSessionByChatIdAndChannel($chatId, $channel);

        if (!$chatSession){
            $chatSession = $this->createChatService($chatId, $channel);
        }

        return $chatSession;
    }

    private function createChatService(int $chatId, string $channel): ChatSession
    {
        $chatSession = (new ChatSession())
            ->setChatId($chatId)
            ->setChannel($channel)
        ;

        $this->chatSessionRepository->save($chatSession);

        return $chatSession;
    }
}
