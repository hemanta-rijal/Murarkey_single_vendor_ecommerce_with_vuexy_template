<?php

namespace Modules\Brand\Contracts;

interface BrandServiceRepo
{
    public function findById($id);
    public function findBySlug($slug);
    public function getAll();
    public function getAllFeatured();
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function getPaginated($number = null);
    public function getPaginationConstant($number = null);
    public function getBrandWithProductCount();
    public function findBy($column, $data);

}
