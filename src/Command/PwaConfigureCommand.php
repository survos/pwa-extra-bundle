<?php

declare(strict_types=1);

namespace Survos\PwaExtraBundle\Command;

use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Attribute\Option;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

#[AsCommand('pwa:configure', 'Create pwa.yaml from composer.json, etc.')]
final class PwaConfigureCommand
{
    public function __construct(private readonly ParameterBagInterface $bag)
    {
    }

    public function __invoke(
        SymfonyStyle $io,
        #[Argument('Application name')] ?string $name = null,
        #[Option('Override existing configuration')] bool $force = false,
    ): int {
        $projectDir = $this->bag->get('kernel.project_dir');
        $composerFilename = $projectDir . '/composer.json';

        if (!file_exists($composerFilename)) {
            $io->writeln('Missing composer.json!');
            return Command::FAILURE;
        }

        $composerData = json_decode(file_get_contents($composerFilename), true);
        foreach (['name', 'description'] as $requiredField) {
            if (!array_key_exists($requiredField, $composerData)) {
                $io->writeln("Missing $requiredField in composer.json, please add it with ");
                $io->writeln("composer config $requiredField ");
                return Command::FAILURE;
            }
        }

        $io->writeln('<info>Done</info>');
        return Command::SUCCESS;
    }
}
