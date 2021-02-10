<?php

namespace App\Domain;

class Map
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
    private $items = [];

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function addItem(MapItem $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return array<\App\Domain\MapItem>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
