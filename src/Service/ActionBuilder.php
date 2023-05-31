<?php

namespace App\Service;

use App\Dto\Message\MessageDto;
use App\Scenario\ActionGroup;
use Symfony\Component\Serializer\SerializerInterface;

class ActionBuilder
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly TelegramService $telegramService,
    ){
    }

    public function go(): void
    {
        $scenario = $this->getFakeScenario();

        /** @var ActionGroup $data */
        $data = $this->serializer->denormalize($scenario, ActionGroup::class);

        // dirt ...

        if ('messages' === $data->getName()) {
            $actions = $data->getActions();

            foreach ($actions as $action){
                $content = $action->getContent();

                $messageDto = (new MessageDto())
                    ->setChatId('873817360')
                    ->setText($content['text'])
                ;

                $this->telegramService->sendMessage($messageDto, '5109953245:AAE7TIhplLRxJdGmM27YSeSIdJdOh4ZXVVY');
            }
        }

        // dirt ...
    }

    private function getFakeScenario(): array
    {
//        return [
//            'clusterId' => '123',
//            'name' => 'messages', // hmmm...
//            'actions' => [
//                [
//                    'type' => 'send',
//                    'content' => [
//                        'text' => 'Hello v rot'
//                    ],
//                ],
//                [
//                    'type' => 'send',
//                    'content' => [
//                        'text' => 'Helasdasd'
//                    ],
//                ],
//            ]
//        ];

        return [
            'clusterId' => '123',
            'name' => 'messages', // hmmm...
            'actions' => [
                [
                    'chatId' => 873817360,
                    'type' => 'send',
                    'content' => 'Hello v rot',
                    'subAction' => 2
                ],
            ]
        ];
    }
}