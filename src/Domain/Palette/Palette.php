<?php

namespace App\Domain\Palette;

use App\Domain\Colour;

class Palette
{
    /**
     * @var array<\App\Domain\Colour>
     */
    private $colours = [];

    public function addColour(Colour $colour): void
    {
        $this->colours[] = $colour;
    }

    public function getSize(): int
    {
        return count($this->colours);
    }

    public function getColours(): array
    {
        return $this->colours;
    }

    public function getColour(int $index): Colour
    {
        return $this->colours[$index];
    }
}
