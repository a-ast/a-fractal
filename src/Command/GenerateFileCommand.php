<?php

declare(strict_types=1);

namespace App\Command;

use App\Domain\Fractal\ColourStrategy;
use App\Domain\Map;
use App\Domain\Fractal\Config;
use App\Domain\Fractal\JuliaSet;
use App\Infrastructure\Image;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateFileCommand extends Command
{
    protected static $defaultName = 'app:file:generate';

    protected function configure(): void
    {
        $this
            ->setDescription('file:generate')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $map = new Map(500, 500);

        $fractal = new JuliaSet();
        $config = new Config();
        $fractal->build($config, $map);

        $colourStrategy = new ColourStrategy($config);

        $image = new Image();
        $image->saveToFile($map, 'var/z.png', $colourStrategy);

        return Command::SUCCESS;;
    }
}
