<?php

namespace App\Controller\Webhook;

use App\Dto\TelegramWebhookDto;
use App\Service\ChatEventService;
use App\Service\ChatSessionService;
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
        private readonly ChatSessionService $chatSessionService,
        private readonly ChatEventService $chatEventService,
    ) {
    }

    /**
     * @throws Exception
     */
    #[Route('/webhook/{id}/{channel}/', name: 'app_webhook', methods: ['POST'])]
    public function addWebhookAction(Request $request, int $id, string $channel): JsonResponse
    {
        $webhookData = $this->serializer->deserialize(
            $request->getContent(),
            TelegramWebhookDto::class,
            'json'
        );

        $chatSession = $this->chatSessionService->getOrCreateChatSession($webhookData->getWebhookChatId(), $channel);

        $this->chatEventService->createChatEventForSession(
            $chatSession,
            $webhookData->getWebhookType(),
            $webhookData->getWebhookContent()
        );

        return new JsonResponse();
    }
}
