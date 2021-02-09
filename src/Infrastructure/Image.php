<?php

namespace App\Infrastructure;

use App\Domain\Canvas;
use App\Domain\Pixel;

class Image
{
    /**
     * @var \App\Domain\Canvas
     */
    private $canvas;

    public function __construct(Canvas $canvas)
    {
        $this->canvas = $canvas;
    }

    public function saveToFile(string $fileName)
    {
        $file = imagecreatetruecolor($this->canvas->getWidth(), $this->canvas->getHeight());
        //imagesetpixel($file, 1, 1, imagecolorallocate($file, 0, 0, 0));

        /** @var Pixel $pixel */
        foreach ($this->canvas->getPixels() as $pixel) {

            $colour = imagecolorallocate($file,
                $pixel->getColour()->getR(),
                $pixel->getColour()->getG(),
                $pixel->getColour()->getB()
            );
            imagesetpixel($file,
                $pixel->getPoint()->getX(),
                $pixel->getPoint()->getY(),
                $colour);
        }

        imagepng($file, $fileName);
    }
}
