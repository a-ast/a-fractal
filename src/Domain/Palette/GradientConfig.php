<?php

namespace App\Domain\Palette;

use App\Domain\Colour;

class GradientConfig
{
    /**
     * @var array<int, Colour>
     */
    private $colours;

    public function __construct(
        Colour $firstColour,
        Colour $lastColour
    ) {
        $this->colours[0] = $firstColour;
        $this->colours[100] = $lastColour;
    }

    public function addInnerColour(Colour $colour, int $percent)
    {
        $this->colours[$percent] = $colour;
    }

    public function getColours(): array
    {
        ksort($this->colours);

        return $this->colours;
    }
}
