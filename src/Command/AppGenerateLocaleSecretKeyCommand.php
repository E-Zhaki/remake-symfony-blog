<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:generate-locale-secret-key',
    description: 'Create .env.dev.local file and initialises and APP_SECRET key',
)]
class AppGenerateLocaleSecretKeyCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $envFile = new SymfonyStyle($input, $output);

        $envFile = '.env.dev.local';

        if (file_exists($envFile)) {
            $io->error("The {$envFile} already exists.");

            return Command::FAILURE;
        }

        $secretKey = bin2hex(random_bytes(16));

        file_put_contents($envFile, "APP_SECRET={$secretKey}");

        $io->success('The .env.dev.local file created and thez APP_SECRET key initialised.');

        return Command::SUCCESS;
    }
}
