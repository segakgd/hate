<?php

namespace App\Controller\Webhook;

use App\Entity\Action;
use App\Repository\ActionRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MainWebhookController extends AbstractController
{
    private const USER_SETTING = [
        'bot_command' => [
            '/command1' => [
                'type' => 'message',
                'content' => 'бла бла бла ',
            ],
            '/command2' => [
                'type' => 'message',
                'content' => 'бла бла бла 2',
            ]
        ]
    ];

    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ActionRepository $actionRepository,
    ) {
    }

    /**
     * @throws Exception
     */
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

    /**
     * @throws Exception
     */
    private function getType(array $arrayWebhookData): ?array // todo не место этой функции тут
    {
        if ($this->isCommand($arrayWebhookData)) {
            return $this->createCommandAction($arrayWebhookData);
        }

        if ($this->isMessage($arrayWebhookData)){
            return $this->createMessageAction($arrayWebhookData);
        }

        return null;
    }

    /**
     * @throws Exception
     */
    private function createCommandAction(array $arrayWebhookData): array // todo не место этой функции тут
    {
        $setting = self::USER_SETTING;

        $action = $setting['bot_command'][$arrayWebhookData['message']['text']] ??
            throw new Exception('Undefined command ' . $arrayWebhookData['message']['text'])
        ;

        $action['chatId'] = $arrayWebhookData['message']['chat']['id'];

        return $action;
    }

    private function createMessageAction(array $arrayWebhookData): array // todo не место этой функции тут
    {
        return [
            'chatId' => $arrayWebhookData['message']['chat']['id'],
            'type' => 'message',
            'content' => $arrayWebhookData['message']['text'],
        ];
    }

    private function isCommand(array $arrayWebhookData): bool // todo не место этой функции тут
    {
        return isset($arrayWebhookData['message']['entities'][0]['type']) &&
            $arrayWebhookData['message']['entities'][0]['type'] === 'bot_command';
    }

    private function isMessage(array $arrayWebhookData): bool // todo не место этой функции тут
    {
        return isset($arrayWebhookData['message']['text']);
    }
}