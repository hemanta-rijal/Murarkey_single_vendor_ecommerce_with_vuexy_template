<?php

namespace Modules\Categories\Contracts;

interface CategoryService
{

    public function getAll();

    public function getPaginated();

    public function create(array $data);

    public function findById(int $id);

    public function getFeaturedCategories();

    public function update(int $id, array $data);

    public function delete(int $id);

    public function getTree();

    public function updateOrder($data);

    public function getChildren($category_id);

    public function extractCategoriesForSearch($products, $withProductCount = false);

    public function getBySlug($category);

    public function findBy($column, $data);

}
