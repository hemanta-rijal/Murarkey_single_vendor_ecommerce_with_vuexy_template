<?php


namespace Modules\ImageTemplates;


use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Image200X200 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(200, 200);
    }
}