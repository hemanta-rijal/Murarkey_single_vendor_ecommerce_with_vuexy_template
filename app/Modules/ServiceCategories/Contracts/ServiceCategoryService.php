<?php

namespace Modules\ServiceCategories\Contracts;

interface ServiceCategoryService
{

    public function getPaginated();

    public function create(array $data);

    public function findById(int $id);

    public function getAll();

    public function getFeaturedCategories();

    public function update(int $id, array $data);

    public function delete(int $id);

    public function lists();

    public function getTree();

    public function updateOrder($data);

    public function import($excelFile);

    public function getChildren($category_id);

    public function extractCategoriesForSearch($products, $withProductCount = false);

    public function getBySlug($category);

}
