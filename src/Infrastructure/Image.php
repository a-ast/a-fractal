<?php

namespace App\Infrastructure;

use App\Domain\Fractal\ColourStrategy;
use App\Domain\Map;
use App\Domain\Palette\Palette;

class Image
{
    public function saveMapToFile(Map $map, string $fileName, ColourStrategy $colourStrategy)
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

    public function savePaletteToFile(Palette $palette, string $fileName)
    {
        $file = imagecreatetruecolor($palette->getSize(), 100);

        /** @var \App\Domain\Colour $colour */
        foreach ($palette->getColours() as $index => $colour) {

            $pixelColour = imagecolorallocate($file,
                $colour->getR(),
                $colour->getG(),
                $colour->getB()
            );

            imageline($file, $index, 0, $index, 99, $pixelColour);
        }

        imagepng($file, $fileName);
    }
}
