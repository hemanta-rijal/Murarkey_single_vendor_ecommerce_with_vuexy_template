<?php

namespace Modules\Brand\Contracts;

interface BrandRepo
{
    public function findById($id);
    public function getAll();
    public function create($data);
    public function update($id,$data);
    public function delete($id);
}