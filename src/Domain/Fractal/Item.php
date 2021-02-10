<?php

namespace App\Domain\Fractal;

use App\Domain\MapItem;
use App\Domain\Point;

class Item implements MapItem
{
    use Point;

    /**
     * @var int
     */
    private $iteration;

    public static function create(int $x, int $y, int $iteration): self
    {
        $item = new self();
        $item->x = $x;
        $item->y = $y;
        $item->iteration = $iteration;

        return $item;
    }

    public function getIteration(): int
    {
        return $this->iteration;
    }
}
