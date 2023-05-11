<?php

namespace App\Controller\Admin;

use App\Dto\Message\MessageDto;
use App\Dto\Webhook\WebhookDto;
use App\Service\TelegramService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebhookController extends AbstractController
{
    public function __construct(
        private readonly TelegramService $telegramService,
    ){
    }

    #[Route('/admin/webhook/add/', name: 'admin.webhook.add', methods: 'GET')]
    public function addWebhookForTelegramBot()
    {
        $webhookDto = (new WebhookDto())
            ->setUrl('https://webhook.site/ecf216da-f254-4141-920a-844f75b9d624')
        ;

        $this->telegramService->setWebhook($webhookDto, '5109953245:AAE7TIhplLRxJdGmM27YSeSIdJdOh4ZXVVY');

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/admin/message/send/test/', name: 'admin.message.send.test', methods: 'GET')]
    public function setTestMessage()
    {
        $messageDto = (new MessageDto())
            ->setChatId(873817360)
            ->setText('ASDASDASD')
        ;

        $this->telegramService->sendMessage($messageDto, '5109953245:AAE7TIhplLRxJdGmM27YSeSIdJdOh4ZXVVY');

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}