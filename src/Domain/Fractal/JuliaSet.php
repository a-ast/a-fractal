<?php

namespace App\Domain\Fractal;

use App\Domain\Map;

class JuliaSet
{
    public function build(Config $config, Map $map)
    {
        $width = $map->getWidth();
        $height = $map->getHeight();

        $widthFactor = 1.0 / ($width - 1);
        $heightFactor = 1.0 / ($height - 1);
        $limit = $config->getEscapeRadius() * $config->getEscapeRadius();

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

                $map->addItem(Item::create($i, $j, $iteration));
            }
        }
    }
}
