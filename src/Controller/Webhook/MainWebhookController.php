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

    private function createChatEventForSession($chatSession, $type, $content): void
    {
        $chatEventId = $chatSession->getChatEvent();

        if (!$chatEventId){
            $scenario = $this->behaviorScenarioService->getScenarioByNameAndType($type, $content);

            $chatEvent = (new ChatEvent())
                ->setType($type)
                ->setBehaviorScenario($scenario->getId())
            ;

            $this->chatEventRepository->saveAndFlush($chatEvent);

            $this->chatSessionRepository->save($chatSession->setChatEvent(
                $chatEvent->getId()
            ));
        } else {
            $chatEvent = $this->chatEventRepository->find($chatEventId);

            if ($this->isMandatoryEvent()){
                throw new Exception('Хз что пришло...');
            }
        }
    }

    public function isMandatoryEvent(): bool
    {
        // todo игнорировать команды

        return false;
    }
}
