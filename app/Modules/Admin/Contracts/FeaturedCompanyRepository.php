<?php


namespace Modules\Admin\Contracts;


interface FeaturedCompanyRepository
{

    public function delete($id);

    public function update($id, $data);

    public function findById($id);

    public function create($data);

    public function getPaginated($number = 15);
}