<?php


namespace Modules\Admin\Contracts;


interface MetaService
{
    public function updateSiteSettings($data, $logo = null);
}