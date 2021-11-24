<?php


namespace Modules\ImageTemplates;
use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;


class Image500X394 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(500, 394);
    }
}