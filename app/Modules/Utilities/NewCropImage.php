<?php


namespace Modules\Utilities;

use Intervention\Image\ImageManagerStatic as Image;

class NewCropImage
{
    protected $path;
    protected $size;
    protected $image;
    protected $width;
    protected $height;

    public function __construct($path, $size)
    {
        $this->path = $path;
        $this->size = $size;

        $this->image = Image::make($path);
    }


    public function crop()
    {
        $this->image->crop($this->size[0], $this->size[1]);

        return $this;
    }

    public function save()
    {
        $pieces = explode('/', $this->path);

        $pieces[count($pieces) - 1] = 'cropped_' . $pieces[count($pieces) - 1];

        $path = implode('/', $pieces);
        $this->image->save($path);

        return $path;
    }

    public function calculateDividingFactor()
    {
        if (!$this->width)
            $this->width = $this->image->width();

        if (!$this->height)
            $this->height = $this->image->height();

        $xRatio = $this->width / $this->size[0];
        $yRatio = $this->height / $this->size[1];

        return $xRatio > $yRatio ? $yRatio : $xRatio;
    }

    public function resize()
    {
        $dividingFactor = $this->calculateDividingFactor();

        $this->image->resize($this->width / $dividingFactor, $this->height / $dividingFactor);

        return $this;
    }
}