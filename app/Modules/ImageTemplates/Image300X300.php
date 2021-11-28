<?php


namespace Modules\ImageTemplates;
use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Image300X300 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(300, 300);
    }
}