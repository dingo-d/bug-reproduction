<?php

declare(strict_types=1);

namespace MadeByDenis\Patchwork\Scenario\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TestCommand extends Command
{

    protected static $defaultName = 'test';

    protected function configure(): void
    {
        $this
            ->setDescription('Test command.')
            ->setHelp('This command outputs some text.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $testRes = file_get_contents(dirname(__FILE__) . '/test.json');
        $names = json_decode($testRes, true);

        $ask = $io->confirm('Do you want to output "Hi!"?', false);

        if ($ask) {
            $io->success('Hi ' . $names[array_rand($names)] . '!');
        } else {
            $io->success('Hello ' . $names[array_rand($names)] . '!');
        }

        return Command::SUCCESS;
    }
}
