<?php

namespace Modules\Admin\Contracts;

interface ThemeSettingServiceInterface
{

    public function create($data);

    public function getPaginated($number = null);

    public function getPaginationConstant($number = null);
}
