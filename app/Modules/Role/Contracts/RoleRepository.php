<?php

namespace Modules\Role\Contracts;

interface RoleRepository
{
    public function findById($id);
    public function getAll();
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function getPaginated($number);
}
