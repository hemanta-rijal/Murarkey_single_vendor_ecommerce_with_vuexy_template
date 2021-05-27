<?php

namespace Modules\Attribute\Contracts;

interface AttributeRepository
{
    public function findById($id);
    public function getAll();
    public function create($data);
    public function update($id,$data);
    public function delete($id);
    public function getPaginated($number);
}