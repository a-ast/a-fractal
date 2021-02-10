<?php

namespace App\Domain\Fractal;

class Config
{
    /**
     * @var float
     */
    private $real = -0.70176; // -0.8

    /**
     * @var float
     */
    private $imag = -0.3842; // 0.156

    /**
     * @var float
     */
    private $minX = -1.0;

    /**
     * @var float
     */
    private $maxX = 1.0;

    /**
     * @var float
     */
    private $minY = -1.0;

    /**
     * @var float
     */
    private $maxY = 1.0;

    /**
     * @var int
     */
    private $maxIterations = 200;

    /**
     * @var float
     */
    private $escapeRadius = 2.0;

    public function getReal(): float
    {
        return $this->real;
    }

    public function getImag(): float
    {
        return $this->imag;
    }

    public function getMinX(): float
    {
        return $this->minX;
    }

    public function getMaxX(): float
    {
        return $this->maxX;
    }

    public function getMinY(): float
    {
        return $this->minY;
    }

    public function getMaxY(): float
    {
        return $this->maxY;
    }

    public function getMaxIterations(): int
    {
        return $this->maxIterations;
    }

    public function getEscapeRadius(): float
    {
        return $this->escapeRadius;
    }
}
