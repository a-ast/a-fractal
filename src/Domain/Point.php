<?php

namespace App\Domain;

trait Point
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function __toString(): string
    {
        return $this->x. ':' . $this->y;
    }
}
