<?php

namespace telegram_client\Service;

use telegram_client\Dto\Message\MessageDto;
use telegram_client\Dto\Webhook\WebhookDto;
use telegram_client\HttpClient\HttpClient;
use telegram_client\HttpClient\HttpClientInterface;
use telegram_client\HttpClient\Request\Request;

class TelegramService implements TelegramServiceInterface
{
    public function sendMessage(HttpClientInterface $httpClient, MessageDto $messageDto, string $token)
    {
        $request = $this->buildRequest(
            $messageDto->getArray(),
            'sendMessage',
        $token,
            HttpClient::METHOD_POST,
        );


        $httpClient->request($request);
    }

    public function setWebhook(HttpClientInterface $httpClient, WebhookDto $webhookDto, string $token)
    {
        $request = $this->buildRequest(
            $webhookDto->getArray(),
            'setWebhook',
            $token,
            HttpClient::METHOD_POST,
        );

        $httpClient->request($request);
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