<?php

namespace App;

class UserSetting
{
    private const USER_SETTING = [
        '/command1' => [
            'type' => 'message',
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
        ],
        '/command2' => [
            'type' => 'message',
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
        ],
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
    ];

    public static function getUserSetting(): array
    {
        return self::USER_SETTING;
    }

    public static function searchNextAction($key): array
    {
        return self::USER_SETTING[$key] ?? [];
    }
}