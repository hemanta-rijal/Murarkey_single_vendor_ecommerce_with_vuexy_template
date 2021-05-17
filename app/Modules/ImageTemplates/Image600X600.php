<?php


namespace Modules\ImageTemplates;


use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Image600X600 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(600, 600);
    }
}