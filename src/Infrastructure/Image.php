<?php

namespace App\Infrastructure;

use App\Domain\Fractal\ColourStrategy;
use App\Domain\Map;

class Image
{
    public function saveToFile(Map $map, string $fileName, ColourStrategy $colourStrategy)
    {
        $file = imagecreatetruecolor($map->getWidth(), $map->getHeight());

        /** @var \App\Domain\Fractal\Item $item */
        foreach ($map->getItems() as $item) {

            $colour = $colourStrategy->getColour($item);

            $pixelColour = imagecolorallocate($file,
                $colour->getR(),
                $colour->getG(),
                $colour->getB()
            );

            imagesetpixel($file,
                $item->getX(),
                $item->getY(),
                $pixelColour);
        }

        imagepng($file, $fileName);
    }
}
