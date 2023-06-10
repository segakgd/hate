<?php

namespace App\Command;

use App\Entity\BehaviorScenario;
use App\Repository\BehaviorScenarioRepository;
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

    public function __construct(
        private readonly BehaviorScenarioRepository $stepRepository,
        string                                      $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->convert(self::USER_SETTING);

        } catch (Throwable $throwable){
            $io->error($throwable->getMessage());

            return Command::FAILURE;
        }


        return Command::SUCCESS;
    }

    private function convert(array $settings, int $ownerId = null): array
    {
        $result = [];


        foreach ($settings as $key => $settingItem) {

            $step = (new BehaviorScenario())
                ->setType($settingItem['type'])
                ->setName($key)
                ->setContent($settingItem['content'])
            ;

            if ($ownerId){
                $step->setOwnerStepId($ownerId);
            }

            $this->stepRepository->save($step);

            if (isset($settingItem['sub'])){
                $resultSud = $this->convert($settingItem['sub'], $step->getId());

                $result = array_merge($result, $resultSud);
            }
        }

        return $result;
    }
}
