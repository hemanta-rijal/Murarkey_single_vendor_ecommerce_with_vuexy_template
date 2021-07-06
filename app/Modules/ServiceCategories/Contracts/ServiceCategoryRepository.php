<?php

namespace Modules\ServiceCategories\Contracts;

interface ServiceCategoryRepository
{

    public function getTree();

    public function updateOrder($data);

    public function insertMany($data);

    public function getAll();

    public function lists();

    public function getFeaturedCategories();

    public function getChildren($id);

    public function getCategoryWithChildrenAndParent($category);

    public function getCategoryAndChildren($categoryId);

    public function alterProductCount($type, $categoryId);

    public function getCategoryAndDescendantBySlug($category);

    public function getCategoryParentAndChild($id);

    public function getCategoryBySlug($category);

}
