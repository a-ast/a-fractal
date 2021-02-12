<?php

declare(strict_types=1);

namespace App\Command;

use App\Domain\Colour;
use App\Domain\Fractal\PaletteColourStrategy;
use App\Domain\Map;
use App\Domain\Fractal\Config;
use App\Domain\Fractal\JuliaSet;
use App\Domain\Palette\GradientBuilder;
use App\Domain\Palette\GradientConfig;
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
        $fractalConfig = new Config();
        $paletteConfig = new GradientConfig(Colour::fromRGB(0, 0, 0), Colour::fromRGB(0, 0, 0));
        $paletteConfig->addInnerColour(Colour::fromRGB(255, 174, 0), 75);

        $paletteBuilder = new GradientBuilder();
        $palette = $paletteBuilder->build($fractalConfig->getMaxIterations()*10, $paletteConfig);

        $map = new Map(1000, 1000);

        $fractal = new JuliaSet();
        $fractal->build($fractalConfig, $map);

        $colourStrategy = new PaletteColourStrategy($fractalConfig, $palette);

        $image = new Image();

        $image->savePaletteToFile($palette, 'var/palette.png');
        $image->saveMapToFile($map, 'var/fractal.png', $colourStrategy);

        return Command::SUCCESS;;
    }
}
