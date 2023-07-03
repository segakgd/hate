<?php

namespace App\Controller\Webhook;

use App\Dto\Webhook\Telegram\TelegramWebhookDto;
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

    //method connected:
    //- ЮKassa Test: 381764678:TEST:60367 2023-06-27 18:42

    //Принято! Ваши тестовые настройки:
    //shopId 506751
    //shopArticleId 538350
    //Для оплаты используйте данные тестовой карты: 1111 1111 1111 1026, 12/22, CVC 000.

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
