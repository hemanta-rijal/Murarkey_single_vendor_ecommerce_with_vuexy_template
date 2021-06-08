<?php

namespace Modules\Admin\Contracts;

interface MetaRepository
{
    public function create(array $data);

    public function findById(int $id);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function getPaginated(int $number);

    public function findByKey($key);

    public function updateValue($key, $value);
}
