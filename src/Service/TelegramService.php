<?php

namespace App\Service;

use App\Dto\Message\MessageDto;
use App\Dto\Webhook\WebhookDto;
use App\HttpClient\HttpClient;
use App\HttpClient\HttpClientInterface;
use App\HttpClient\Request\Request;

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