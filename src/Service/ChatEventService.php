<?php

namespace App\Service;

use App\Entity\ChatEvent;
use App\Entity\ChatSession;
use App\Repository\ChatEventRepository;
use App\Repository\ChatSessionRepository;
use App\Service\Scenario\BehaviorScenarioService;
use Exception;

class ChatEventService
{
    public function __construct(
        private readonly ChatEventRepository $chatEventRepository,
        private readonly ChatSessionRepository $chatSessionRepository,
        private readonly BehaviorScenarioService $behaviorScenarioService,
    ) {
    }

    /**
     * @throws Exception
     */
    public function createChatEventForSession($chatSession, $type, $content): void
    {
        $chatEventId = $chatSession->getChatEvent();

        if ($chatEventId){
            $chatEvent = $this->chatEventRepository->find($chatEventId);

            // если мы находимся тут, это значит что пора проверить, можем ли мы затереть собитие, которое ожидает что-то или нет.
            if (null !== $chatEvent && $this->isMandatoryEvent($chatEvent, $type)){
                throw new Exception('Событие обязательно, нужно уведомить пользователя об этом');
            }

            if (null !== $chatEvent){
                $this->rewriteChatEventByScenario($chatSession, $type, $content);

                return;
            }
        }

        $this->createChatEventByScenario($chatSession, $type, $content);
    }

    private function createChatEventByScenario(ChatSession $chatSession, string $type, string $content): void
    {
        $scenario = $this->behaviorScenarioService->getScenarioByNameAndType($type, $content);

        $chatEvent = $this->createChatEvent($type, $scenario->getId());
        $chatEventId = $chatEvent->getId();

        $chatSession->setChatEvent($chatEventId);

        $this->chatSessionRepository->save($chatSession);

    }

    private function rewriteChatEventByScenario(ChatSession $chatSession, string $type, string $content): void
    {
        $scenario = $this->behaviorScenarioService->getScenarioByNameAndType($type, $content);

        $chatEvent = $this->createChatEvent($type, $scenario->getId());

        $oldEventId = $chatSession->getChatEvent();
        $chatEventId = $chatEvent->getId();

        // обновляем сессию
        $chatSession->setChatEvent($chatEventId);

        $this->chatSessionRepository->save($chatSession);

        // старое событие удаляем
        $oldEvent = $this->chatEventRepository->find($oldEventId);
        $this->chatEventRepository->remove($oldEvent);
    }

    private function createChatEvent(string $type, int $scenarioId): ChatEvent
    {
        $chatEvent = (new ChatEvent())
            ->setType($type)
            ->setBehaviorScenario($scenarioId)
        ;

        $this->chatEventRepository->saveAndFlush($chatEvent);

        return $chatEvent;
    }

    private function isMandatoryEvent(ChatEvent $chatEvent, string $type): bool
    {
        if ($type === 'command') {
            return false;
        }

        if (empty($chatEvent->getActionAfter())) {
            return false;
        }

        return true;
    }
}
