<?php

namespace App\Command;

use App\Dto\Telegram\Webhook\WebhookDto;
use App\Service\Client\Telegram\TelegramService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'tg:add:webhook',
    description: 'Add webhook',
)]
class TgAddWebhookCommand extends Command
{
    public function __construct(
        private readonly TelegramService $telegramService,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $webhookDto = (new WebhookDto())
            ->setUrl('https://webhook.site/bec17a54-f0ac-4bab-9431-e3f1d4834a6e')
        ;

        $this->telegramService->setWebhook($webhookDto, '5109953245:AAE7TIhplLRxJdGmM27YSeSIdJdOh4ZXVVY');

        return Command::SUCCESS;
    }
}
