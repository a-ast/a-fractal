<?php

namespace App\Domain\Fractal;

use App\Domain\Colour;
use App\Domain\Palette\Palette;

class PaletteColourStrategy implements ColourStrategy
{
    /**
     * @var \App\Domain\Fractal\Config
     */
    private $config;

    /**
     * @var \App\Domain\Palette\Palette
     */
    private $palette;

    public function __construct(Config $config, Palette $palette)
    {
        $this->config = $config;
        $this->palette = $palette;
    }

    public function getColour(Item $item): Colour
    {
        $index = round($this->palette->getSize() * $item->getIteration() / $this->config->getMaxIterations());

        return $this->palette->getColour($index);
    }
}
