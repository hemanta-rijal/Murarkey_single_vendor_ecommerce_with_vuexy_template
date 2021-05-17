<?php


namespace App\Http\Middleware;


use Closure;
use Intervention\Image\ImageManagerStatic as Image;


class FixImageOrientate
{
    public function handle($request, Closure $next)
    {
        foreach ($request->file() as $file) {
            $path = $file->path();
            try {
                Image::make($path)->orientate()->save($path);
            }catch (\Exception $e) {

            }

        }

        return $next($request);
    }
}