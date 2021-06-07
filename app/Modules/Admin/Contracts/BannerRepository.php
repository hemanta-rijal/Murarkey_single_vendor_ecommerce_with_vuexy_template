<?php

namespace Modules\Admin\Contracts;

interface BannerRepository
{

    public function findByType($type);
}
