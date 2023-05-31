<?php

namespace App\Controller\Webhook;

use App\Entity\Action;
use App\Repository\ActionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MainWebhookController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ActionRepository $actionRepository,
    ) {
    }

    #[Route('/webhook/', name: 'app_webhook', methods: ['POST'])]
    public function addWebhookAction(Request $request): JsonResponse
    {
        $arrayWebhookData = $this->serializer->decode($request->getContent(), 'json');

        $webhookType = $this->getType($arrayWebhookData);

        $action = (new Action())
            ->setType($webhookType['type'])
            ->setChatId($webhookType['chatId'])
            ->setContent($webhookType['content'])
        ;

        $this->actionRepository->saveAndFlush($action);

        return new JsonResponse();
    }

    private function getType(array $arrayWebhookData): ?array // todo не место этой функции тут
    {
        if (isset($arrayWebhookData['message']['text'])){
            return [
                'chatId' => $arrayWebhookData['message']['chat']['id'],
                'type' => 'message',
                'content' => $arrayWebhookData['message']['text'],
            ];
        }

        return null;
    }
}