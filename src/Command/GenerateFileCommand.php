<?php

declare(strict_types=1);

namespace App\Command;

use App\Domain\Canvas;
use App\Domain\Fractal\Julia;
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
        $canvas = new Canvas(1000, 1000);
        $fractal = new Julia();
        $fractal->build($canvas);

        $image = new Image($canvas);
        $image->saveToFile('var/z.png');

        return Command::SUCCESS;;
    }
}
