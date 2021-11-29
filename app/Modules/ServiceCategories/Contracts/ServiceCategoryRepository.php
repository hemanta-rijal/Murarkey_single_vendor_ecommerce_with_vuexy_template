<?php

namespace Modules\ServiceCategories\Contracts;

interface ServiceCategoryRepository
{

    public function getTree();

    public function updateOrder($data);

    public function insertMany($data);

    public function getAll();

    public function lists();

    public function findBySlug($lsug);

    public function getFeaturedCategories();

    public function delete($id);

    public function getChildren($id);

    public function getCategoryWithChildrenAndParent($category);

    public function getCategoryAndChildren($categoryId);

    public function alterProductCount($type, $categoryId);

    public function getCategoryAndDescendantBySlug($category);

    public function getCategoryParentAndChild($id);

    public function getCategoryBySlug($category);

    public function getParentCategoryOnly();

    public function findBy($column,$data);

}
