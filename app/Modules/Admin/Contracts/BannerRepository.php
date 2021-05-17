<?php


namespace Modules\Admin\Contracts;


interface BannerRepository
{

    public function findBySlug($slug);
}