<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'tg:go',
    description: 'Add a short description for your command',
)]
class TgGoCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {


//        $io = new SymfonyStyle($input, $output);
//
//        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
//        $io->error('asdasd');

        return Command::SUCCESS;
    }
}
