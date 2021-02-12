<?php

namespace App\Domain\Fractal;

use App\Domain\Colour;

interface ColourStrategy
{
    public function getColour(Item $item): Colour;
}
