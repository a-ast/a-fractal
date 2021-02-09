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
        $this->pixels[] = $pixel;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return array<\App\Domain\Pixel>
     */
    public function getPixels(): array
    {
        return $this->pixels;
    }
}
