<?php

namespace App\Command;

use App\Dto\Message\MessageDto;
use App\Repository\ActionRepository;
use App\Service\ActionBuilder;
use App\Service\TelegramService;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(
    name: 'tg:go',
    description: 'Add a short description for your command',
)]
class TgGoCommand extends Command
{
    public function __construct(
        private readonly TelegramService $telegramService,
        private readonly ActionRepository $actionRepository,
        string $name = null
    ) {
        parent::__construct($name);
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $isSuccess = false;

        try {
            $action = $this->actionRepository->findOneBy([]) ?? throw new Exception('Action not found');

            if ('message' === $action->getType()) {
                $messageDto = (new MessageDto())
                    ->setChatId($action->getChatId())
                    ->setText($action->getContent())
                ;

                $this->telegramService->sendMessage($messageDto, '5109953245:AAE7TIhplLRxJdGmM27YSeSIdJdOh4ZXVVY');

                $this->actionRepository->remove($action);
                $isSuccess = true;
            }
        } catch (Throwable $throwable){
            $io->error($throwable->getMessage());

            return Command::FAILURE;
        }

        if (!$isSuccess){
            $io->error('Command is not success');
        } else {
            $io->success('Command is success');
        }

        return Command::SUCCESS;
    }
}
