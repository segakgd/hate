<?php

namespace App\Service\Handler\Items;

use App\Dto\Core\Telegram\Message\MessageDto;
use App\Entity\ChatEvent;
use App\Repository\BehaviorScenarioRepository;
use App\Repository\ChatSessionRepository;
use App\Service\Client\Telegram\TelegramService;

class MessageHandler
{
    public function __construct(
        private readonly TelegramService $telegramService,
        private readonly BehaviorScenarioRepository $behaviorScenarioRepository,
        private readonly ChatSessionRepository $chatSessionRepository,
    ) {
    }

    public function handle(ChatEvent $chatEvent): void
    {
        $behaviorScenarioId = $chatEvent->getBehaviorScenario();

        $behaviorScenario = $this->behaviorScenarioRepository->find($behaviorScenarioId);
        $behaviorScenarioContent = $behaviorScenario->getContent();

        $chatSession = $this->chatSessionRepository->findOneBy(
            [
                'chatEvent' => $chatEvent->getId()
            ]
        );

        $messageDto = (new MessageDto())
            ->setChatId($chatSession->getChatId())
            ->setText($behaviorScenarioContent['message'])
        ;

        if(!empty($behaviorScenarioContent['replyMarkup'])){
            $messageDto->setReplyMarkup($behaviorScenarioContent['replyMarkup']);
        }

        $this->telegramService->sendMessage($messageDto, '5109953245:AAE7TIhplLRxJdGmM27YSeSIdJdOh4ZXVVY');
    }
}