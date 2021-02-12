<?php

namespace App\Domain\Palette;

use App\Domain\Colour;

class GradientBuilder
{
    public function build(int $length, GradientConfig $config): Palette
    {
        $palette = new Palette();

        $from = 0;
        $fromColour = Colour::noColour();

        foreach ($config->getColours() as $percent => $colour) {
            if ($percent === $from) {
                continue;
            }

            $to = $percent;
            $toColour = $colour;
            $size = round($length * ($to - $from) / 100);

            for ($i = 0; $i < $size; $i++) {

                $r = $this->interpolateLinear($i, 0, $size, $fromColour->getR(), $toColour->getR());
                $g = $this->interpolateLinear($i, 0, $size, $fromColour->getG(), $toColour->getG());
                $b = $this->interpolateLinear($i, 0, $size, $fromColour->getB(), $toColour->getB());

                $palette->addColour(Colour::fromRGB($r, $g, $b));
            }

            $from = $percent;
            $fromColour = $colour;
        }



        return $palette;
    }

    private function interpolateLinear(int $x, int $x1, int $x2, int $y1, int $y2): int
    {
        return $y1 + (int)(($x - $x1) * ($y2 - $y1) / ($x2 - $x1));
    }
}
