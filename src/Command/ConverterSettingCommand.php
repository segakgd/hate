<?php

namespace App\Command;

use App\Converter\SettingConverter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(
    name: 'tg:convert',
    description: 'Convert user setting',
)]
class ConverterSettingCommand extends Command
{
    private const USER_SETTING = [
        '/command1' => [
            'type' => 'command',
            'content' => [
                'message' => 'Что делаешь?',
                'replyMarkup' => [
                    [
                        [
                            'text' => 'Ничего'
                        ],
                        [
                            'text' => 'Что-то'
                        ],
                    ]
                ]
            ],
            'sub' => [
                'Хорошо' => [
                    'type' => 'message',
                    'content' => [
                        'message' => 'Хорошо что всё хорошо',
                    ],
                ],
                'Плохо' => [
                    'type' => 'message',
                    'content' => [
                        'message' => 'Плохо что всё плохо',
                    ],
                ],
            ]
        ],
        '/command2' => [
            'type' => 'command',
            'content' => [
                'message' => 'Как дела?',
                'replyMarkup' => [
                    [
                        [
                            'text' => 'Хорошо'
                        ],
                        [
                            'text' => 'Плохо'
                        ],
                    ]
                ]
            ],
            'sub' => [
                'Ничего' => [
                    'type' => 'message',
                    'content' => [
                        'message' => 'Ничего так ничего',
                    ],
                ],
                'Что-то' => [
                    'type' => 'message',
                    'content' => [
                        'message' => 'Что-то это что?',
                    ],
                ],
            ]
        ],
    ];

    private const USER_SETTING_2 = [
        '/command1' => [
            'type' => 'command',
            'content' => [
                'message' => 'Как вас зовут? (ФИО)',
            ],
            'actionAfter' => [
                'contact' => [
                    'name' => [
                        'save'
                    ]
                ]
            ],
            'sub' => [
                '#' => [
                    'type' => 'message',
                    'content' => [
                        'message' => 'Гони номер телефона',
                    ],
                    'actionAfter' => [
                        'contact' => [
                            'phone' => [
                                'save'
                            ]
                        ]
                    ],
                    'sub' => [
                        '#' => [
                            'type' => 'message',
                            'content' => [
                                'message' => 'Спасибо, мы с вами свяжемся',
                            ],
                        ],
                    ]
                ],
            ]
        ],
    ];

    public function __construct(
        private readonly SettingConverter $settingConverter,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->settingConverter->convert(self::USER_SETTING_2);

        } catch (Throwable $throwable){
            $io->error($throwable->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
