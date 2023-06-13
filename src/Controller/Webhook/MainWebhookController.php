<?php

namespace App\Controller\Webhook;

use App\Dto\TelegramWebhookDto;
use App\Entity\ChatEvent;
use App\Entity\ChatSession;
use App\Repository\ChatEventRepository;
use App\Repository\ChatSessionRepository;
use App\Service\Scenario\BehaviorScenarioService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MainWebhookController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ChatEventRepository $chatEventRepository,
        private readonly ChatSessionRepository $chatSessionRepository,
        private readonly BehaviorScenarioService $behaviorScenarioService,
    ) {
    }

    /**
     * @throws Exception
     */
    #[Route('/webhook/{channel}/{id}/', name: 'app_webhook', methods: ['POST'])]
    public function addWebhookAction(Request $request, string $channel, int $id): JsonResponse
    {
        $webhookData = $this->serializer->deserialize(
            $request->getContent(),
            TelegramWebhookDto::class,
            'json'
        );

        $chatSession = $this->getOrCreateChatSession($webhookData->getWebhookChatId(), $channel);

        $this->createChatEventForSession(
            $chatSession,
            $webhookData->getWebhookType(),
            $webhookData->getWebhookContent()
        );

        return new JsonResponse();
    }

    private function getOrCreateChatSession(int $chatId, string $channel): ?ChatSession
    {
        $chatSession = $this->chatSessionRepository->getSessionByChatMessage(
            $chatId,
            $channel
        );

        if (!$chatSession){
            $chatSession = (new ChatSession())
                ->setChatId($chatId)
                ->setChannel($channel)
            ;

            $this->chatSessionRepository->save($chatSession);
        }

        return $chatSession;
    }

    /**
     * @throws Exception
     */
    private function createChatEventForSession($chatSession, $type, $content): void
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

    public function createChatEvent(string $type, int $scenarioId): ChatEvent
    {
        $chatEvent = (new ChatEvent())
            ->setType($type)
            ->setBehaviorScenario($scenarioId)
        ;

        $this->chatEventRepository->saveAndFlush($chatEvent);

        return $chatEvent;
    }

    /**
     * НЕ Является обязательным событием
     */
    public function isMandatoryEvent(ChatEvent $chatEvent, string $type): bool
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
