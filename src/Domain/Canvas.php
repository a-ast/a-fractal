<?php

namespace App\Domain;

class Canvas
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var array[][]
     */
    private $pixels = [];

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function addPixel(Pixel $pixel): void
    {
        $this->pixels[$pixel->getPoint()->getX()][$pixel->getPoint()->getY()] = $pixel->getColour();
    }
}
