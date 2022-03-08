<?php

namespace Modules\Brand\Contracts;

interface BrandRepo
{
    public function findById($id);
    public function findBySlug($slug);
    public function getAll();
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function getBrandWithProductCount($name=null);
    public function findBy($column, $data);
}
