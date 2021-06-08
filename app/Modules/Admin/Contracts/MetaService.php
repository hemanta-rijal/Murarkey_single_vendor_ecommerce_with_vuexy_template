<?php

namespace Modules\Admin\Contracts;

interface MetaService
{
    public function create(array $data);

    public function update(int $id, array $data);

    public function findById(int $id);

    public function delete(int $id);

    public function getPaginated(int $number = null);

    public function getPaginationConstant($number = null);

    public function findByKey($key);

    public function updateSiteSettings($data);
}
