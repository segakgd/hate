<?php

namespace App\Command;

use App\Dto\Core\Telegram\Invoice\InvoiceDto;
use App\Dto\Ecommerce\ProductDto;
use App\Service\Client\Telegram\TelegramService;
use App\Service\Ecommerce\EcommerceService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'tg:product',
    description: '',
)]
class ProductCommand extends Command
{
    public function __construct(
        private readonly TelegramService $telegramService,
        private readonly EcommerceService $ecommerceService,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $replyMarkup = [
            [
                [
                    'text' => 'go go go',
                    'pay' => true
                ],
                [
                    'text' => 'Что-то',
                    'callback_data'=>'{"action":"like","count":0,"text":":like:"}'
                ],
                [
                    'text' => 'Что-то',
                    'callback_data'=>'{"action":"like","count":0,"text":":like:"}'
                ],
                [
                    'text' => 'Что-то',
                    'callback_data'=>'{"action":"like","count":0,"text":":like:"}'
                ],
            ],
            [
                [
                    'text' => 'Что-то',
                    'callback_data'=>'{"action":"like","count":0,"text":":like:"}'
                ],
                [
                    'text' => 'Что-то',
                    'callback_data'=>'{"action":"like","count":0,"text":":like:"}'
                ],
                [
                    'text' => 'Что-то',
                    'callback_data'=>'{"action":"like","count":0,"text":":like:"}'
                ],
            ]
        ];

        $chatId = 873817360;

        $products = $this->ecommerceService->getProducts();
        $product = null;

        if ($products[0] instanceof ProductDto){
            $product = $products[0];
        }

        $invoiceDto = (new InvoiceDto())
            ->setChatId($chatId)
            ->setTitle($product?->getName() ?? 'bla bla bla')
            ->setDescription('его тут пока что нет')
            ->setPayload("200")
            ->setProviderToken("381764678:TEST:60367")
            ->setCurrency("RUB")
            ->setPrices( json_encode([
                [
                    'label' => 'first',
                    'amount' => $product?->getPrice()->getValue(),
                ] ])
            )
            ->setPhotoUrl($product?->getImage() ?? '')
            ->setReplyMarkup($replyMarkup)
        ;


//        dd($invoiceDto->getArray());

        $this->telegramService->sendInvoice($invoiceDto, '5109953245:AAE7TIhplLRxJdGmM27YSeSIdJdOh4ZXVVY');

        return Command::SUCCESS;
    }
}
