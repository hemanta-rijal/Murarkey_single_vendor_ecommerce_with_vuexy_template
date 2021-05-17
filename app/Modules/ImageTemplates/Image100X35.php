<?php


namespace Modules\ImageTemplates;


use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Image100X35 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(100, 35);
    }
}