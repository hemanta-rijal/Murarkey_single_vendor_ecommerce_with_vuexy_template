<?php


namespace Modules\Utilities;


use Intervention\Image\ImageManagerStatic as Image;

class ProcessImage
{
    protected $imageCropper;
    protected $image;
    protected $size;
    protected $path;

    public function __construct($path, $size)
    {
        $this->path = $path;
        $this->image = Image::make($path);
        $this->size = $size;
    }

    public function getLongerDimension()
    {
        return $this->image->height() > $this->image->width() ? $this->image->height() : $this->image->width();
    }

    public function crop()
    {
        $length = $this->getLongerDimension();
        $background = Image::canvas($length, $length);
        $background->fill('#fff');
        $background->insert($this->image, 'center');

        $this->image = $background;

        $this->image->crop($length, $length);

        return $this;
    }

    public function fit()
    {
        if (is_array($this->size))
            $this->image->fit($this->size[0], $this->size[1]);
        else
            $this->image->fit($this->size);

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
}