<?php


namespace Modules\Utilities;


use Intervention\Image\ImageManagerStatic as Image;

class CropImage
{

    protected $path;
    protected $position;
    protected $size;
    protected $image;

    public function __construct($path, $position, $size)
    {
        $this->path = $path;
        $this->position = $position;
        $this->size = $size;

        $this->image = Image::make($path);
    }


    public function crop()
    {
        $this->image->crop($this->size[0], $this->size[1], $this->position[0], $this->position[1]);
        
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