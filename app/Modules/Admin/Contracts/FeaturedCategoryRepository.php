<?php


namespace Modules\Admin\Contracts;


interface FeaturedCategoryRepository
{

    public function delete($id);

    public function update($id, $data);
}