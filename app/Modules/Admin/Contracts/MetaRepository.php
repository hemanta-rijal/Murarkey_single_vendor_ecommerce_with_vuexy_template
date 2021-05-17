<?php


namespace Modules\Admin\Contracts;


interface MetaRepository
{
    public function updateValue($key, $value);
}