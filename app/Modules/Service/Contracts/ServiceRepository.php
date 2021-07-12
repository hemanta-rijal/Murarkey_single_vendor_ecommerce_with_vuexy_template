<?php

namespace Modules\Service\Contracts;

interface ServiceRepository
{
    public function findById($id);
    public function getAll();
    public function getPopularServices();
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}
