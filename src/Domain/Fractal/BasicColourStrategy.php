<?php

namespace App\Domain\Fractal;

use App\Domain\Colour;

class BasicColourStrategy implements ColourStrategy
{
    /**
     * @var \App\Domain\Fractal\Config
     */
    private $config;

    /**
     * @var float
     */
    private $colourFactor;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->colourFactor = 1 / log($config->getMaxIterations()) * 255;
    }

    public function getColour(Item $item): Colour
    {
        $col1 = (int)((15.1 * log($item->getIteration()) * $this->colourFactor) % 255);
        $col2 = (int)((1.2 * $item->getIteration()) % $this->config->getMaxIterations());

        return Colour::fromRGB(0, $col2, $col1);
    }
}
