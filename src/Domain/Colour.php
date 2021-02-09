<?php

namespace App\Domain;

class Colour
{
    /**
     * @var int
     */
    private $r;

    /**
     * @var int
     */
    private $g;

    /**
     * @var int
     */
    private $b;

    private function __construct(int $r, int $g, int $b)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
    }

    public static function createFromRGB(int $r, int $g, int $b)
    {
        return new self($r, $g, $b);
    }

    public function getR(): int
    {
        return $this->r;
    }

    public function getG(): int
    {
        return $this->g;
    }

    public function getB(): int
    {
        return $this->b;
    }

    public function __toString(): string
    {
        return $this->r. '/' . $this->g . '/' . $this->b;
    }
}
