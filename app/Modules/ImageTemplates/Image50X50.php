<?php


namespace Modules\ImageTemplates;


use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Image50X50 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(50, 50);
    }
}