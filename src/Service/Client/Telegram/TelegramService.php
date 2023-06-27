<?php

namespace App\Service\Client\Telegram;

use App\Dto\Telegram\Invoice\InvoiceDto;
use App\Dto\Telegram\Message\MessageDto;
use App\Dto\Telegram\Webhook\WebhookDto;
use App\Service\Client\Http\HttpClient;
use App\Service\Client\Http\HttpClientInterface;
use App\Service\Client\Http\Request\Request;

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

    public function sendInvoice(InvoiceDto $messageDto, string $token): void
    {
        $request = $this->buildRequest(
            $messageDto->getArray(),
            'sendInvoice',
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