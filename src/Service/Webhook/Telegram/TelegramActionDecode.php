<?php

namespace App\Service\Webhook\Telegram;

use App\UserSetting;
use Exception;

class TelegramActionDecode
{
    /**
     * @throws Exception
     */
    public function getType(array $arrayWebhookData): ?array
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
    private function createCommandAction(array $arrayWebhookData): array
    {
        $action = UserSetting::searchNextAction($arrayWebhookData['message']['text']) ??
            throw new Exception('Undefined command ' . $arrayWebhookData['message']['text'])
        ;

        $action['chatId'] = $arrayWebhookData['message']['chat']['id'];

        return $action;
    }

    /**
     * @throws Exception
     */
    private function createMessageAction(array $arrayWebhookData): array
    {
        $action = UserSetting::searchNextAction($arrayWebhookData['message']['text']) ??
            throw new Exception('Undefined command ' . $arrayWebhookData['message']['text'])
        ;

        $action['chatId'] = $arrayWebhookData['message']['chat']['id'];

        return $action;
    }

    private function isCommand(array $arrayWebhookData): bool
    {
        return isset($arrayWebhookData['message']['entities'][0]['type']) &&
            $arrayWebhookData['message']['entities'][0]['type'] === 'bot_command';
    }

    private function isMessage(array $arrayWebhookData): bool
    {
        return isset($arrayWebhookData['message']['text']);
    }
}