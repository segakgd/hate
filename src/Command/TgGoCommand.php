<?php

namespace App\Command;

use App\Repository\ChatEventRepository;
use App\Service\Handler\ActionHandler;
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
        private readonly ChatEventRepository $chatEventRepository,
        private readonly ActionHandler $actionHandler,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $action = $this->chatEventRepository->findOneBy([]) ?? throw new Exception('Action not found');

//            dd($action);

            $isSuccess = $this->actionHandler->handle($action);

            if ($isSuccess){
//                $this->chatEventRepository->remove($action);
            }
        } catch (Throwable $throwable){
            dd($throwable);
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
