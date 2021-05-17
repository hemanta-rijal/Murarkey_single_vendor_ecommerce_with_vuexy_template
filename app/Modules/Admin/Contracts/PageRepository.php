<?php


namespace Modules\Admin\Contracts;


interface PageRepository
{
    public function delete($id);

    public function findBySlug($key);

    public function findById($id);

    public function update($id, $data);

    public function create($data);
}