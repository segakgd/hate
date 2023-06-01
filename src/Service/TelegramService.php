<?php

namespace App\Service;

use App\Dto\Message\MessageDto;
use App\Dto\Webhook\WebhookDto;
use App\HttpClient\HttpClient;
use App\HttpClient\HttpClientInterface;
use App\HttpClient\Request\Request;

class TelegramService implements TelegramServiceInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {
    }

    public function sendMessage(MessageDto $messageDto, string $token): void
    {
        $request = $this->buildRequest(
            $messageDto->getArray(),
            'sendMessage',
        $token,
            HttpClient::METHOD_POST,
        );

        $this->httpClient->request($request);
    }

    public function setWebhook(WebhookDto $webhookDto, string $token): void
    {
        $request = $this->buildRequest(
            $webhookDto->getArray(),
            'setWebhook',
            $token,
            HttpClient::METHOD_POST,
        );

        $this->httpClient->request($request);
    }

    public function sendReplyKeyboardMarkup(string $token): void
    {
        $request = $this->buildRequest(
            [
                'chat_id' => 873817360,
                'text' => 'sssss',
                'reply_markup' => json_encode([
                    'keyboard' => $this->keyboardNormalize(),
                ])
            ],
            'sendMessage',
            $token,
            HttpClient::METHOD_POST,
        );

        $this->httpClient->request($request);
    }

    private function keyboardNormalize(): array
    {
        $result = [];
        $keyboards = [
            ['text' => 'sad'],
            ['text' => 'asds'],
        ];

        foreach ($keyboards as $keyboard){
            $result[] = [
                [
                    'text' => $keyboard['text']
                ],
                [
                    'text' => $keyboard['text']
                ],
            ];
        }

        return $result;
    }

    private function buildRequest(array $data, string $scenario, string $token, string $method): Request
    {
        return (new Request())
            ->setData($data)
            ->setScenario($scenario)
            ->setToken($token)
            ->setMethod($method)
        ;
    }
}