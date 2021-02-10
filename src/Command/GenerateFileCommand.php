<?php

declare(strict_types=1);

namespace App\Command;

use App\Domain\Canvas;
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
        $canvas = new Canvas(500, 500);
        $fractal = new JuliaSet();
        $fractal->build(new Config(), $canvas);

        $image = new Image($canvas);
        $image->saveToFile('var/z.png');

        return Command::SUCCESS;;
    }
}
