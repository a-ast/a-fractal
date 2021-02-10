<?php

namespace App\Domain\Fractal;

use App\Domain\Canvas;
use App\Domain\Colour;
use App\Domain\Pixel;

class JuliaSet
{
    public function build(Config $config, Canvas $canvas)
    {
        $width = $canvas->getWidth();
        $height = $canvas->getHeight();

        $widthFactor = 1.0 / ($width - 1);
        $heightFactor = 1.0 / ($height - 1);
        $limit = $config->getEscapeRadius() * $config->getEscapeRadius();

        $colourFactor = 1 / log($config->getMaxIterations()) * 255;

        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                $x = $config->getMinX() + $i * (($config->getMaxX() - $config->getMinX()) * $widthFactor);
                $y = $config->getMinY() + $j * (($config->getMaxY() - $config->getMinY()) * $heightFactor);

                $iteration = 0;
                $z0 = $x;
                $z1 = $y;
                $x2 = $x * $x;
                $y2 = $y * $y;

                // If the |z| > 2 ever, then the sequence will tend to infinity so we can exit the loop
                while ($x2 + $y2 < $limit && $iteration <= $config->getMaxIterations()) {
                    $z1 = 2 * $z0 * $z1 + $config->getImag();
                    $z0 = $x2 - $y2 + $config->getReal();

                    $x2 = $z0 * $z0;
                    $y2 = $z1 * $z1;

                    ++$iteration;
                }

                if ($iteration >= $config->getMaxIterations()) {
                    continue;
                }
                $col1 = (int)((22*log($iteration) * $colourFactor) % 255);
                $col2 = (int)((1.2 * $iteration) % $config->getMaxIterations());
                $colour = Colour::createFromRGB(0, $col2, $col1);

                $canvas->addPixel(
                    Pixel::createFromCoordinatesAndColour($i, $j, $colour)
                );

            }
        }
    }
}
