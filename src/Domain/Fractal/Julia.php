<?php

namespace App\Domain\Fractal;

use App\Domain\Canvas;
use App\Domain\Colour;
use App\Domain\Pixel;

class Julia
{

    public function build(Canvas $canvas)
    {
        $juliaReal = -0.70176;
        $juliaImag = -0.3842;

//        $juliaReal = -0.8;
//        $juliaImag = 0.156;

        $width = $canvas->getWidth();
        $height = $canvas->getHeight();

        $minX = -1.0;
        $maxX = 1.0;
        $minY = -1.0;
        $maxY = 1.0;

        $maxIterations = 300;
        $limit = 4.0;

        $colourFactor = 1 / log($maxIterations) * 255;
        $widthFactor = 1.0 / ($width - 1);
        $heightFactor = 1.0 / ($height - 1);

        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                // What values of x and y does this pixel represent?
                $x = $minX + $i * (($maxX - $minX) * $widthFactor);
                $y = $minY + $j * (($maxY - $minY) * $heightFactor);

                $iteration = 0;
                $z0 = $x;
                $z1 = $y;

                // Optimization: Store x^2 and y^2 so we don't have to keep calculating it
                $x2 = $x * $x;
                $y2 = $y * $y;

                // If the |z| > 2 ever, then the sequence will tend to infinity so we can exit the loop
                while ($x2 + $y2 < $limit && $iteration <= $maxIterations) {
                    $z1 = 2 * $z0 * $z1 + $juliaImag;
                    $z0 = $x2 - $y2 + $juliaReal;

                    $x2 = $z0 * $z0;
                    $y2 = $z1 * $z1;

                    ++$iteration;
                }

                if ($iteration >= $maxIterations) {

                    //$canvas->addPixel(Pixel::createFromCoordinatesAndColour($x, $y, Colour::createFromRGB(0, 0,0)));
                } else {
                    $changingColourPart = (int)(log($iteration) * $colourFactor);

                    $canvas->addPixel(
                        Pixel::createFromCoordinatesAndColour($i, $j, Colour::createFromRGB(0, $changingColourPart, 55))
                    );
                }
            }
        }
    }
}
