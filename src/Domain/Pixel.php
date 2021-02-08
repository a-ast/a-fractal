<?php

namespace App\Domain;

class Pixel
{
    /**
     * @var \App\Domain\Point
     */
    private $point;

    /**
     * @var \App\Domain\Colour
     */
    private $colour;

    private function __construct(Point $point, Colour $colour)
    {
        $this->point = $point;
        $this->colour = $colour;
    }

    public static function createFromPointAndColour(Point $point, Colour $colour)
    {
        return new self($point, $colour);
    }
}
