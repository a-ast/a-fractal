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

    public static function createFromCoordinatesAndColour(int $x, int $y, Colour $colour)
    {
        return new self(Point::create($x, $y), $colour);
    }

    public function getPoint(): Point
    {
        return $this->point;
    }

    public function getColour(): Colour
    {
        return $this->colour;
    }

    public function __toString(): string
    {
        return $this->getPoint() . ' ' . $this->getColour();
    }
}
