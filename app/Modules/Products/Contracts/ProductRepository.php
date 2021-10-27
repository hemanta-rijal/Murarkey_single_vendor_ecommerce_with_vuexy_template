<?php

namespace Modules\Products\Contracts;

interface ProductRepository
{
    public function create($data);

    public function getPaginated($type = null, $search = null, int $number = null, $companyId = null, $userId = null);

    public function findById($id);

    public function findBySlug($slug);

    public function getTrashItems($companyId = null, $userId = null);

    public function getTrashedItemById($id, $companyId = null, $userId = null);

    public function getProductCountByStatus($key, $companyId = null, $userId = null);

    public function findProductWithCompanyIdAndUserId($id, $companyId, $userId);

    public function emptyTrash($companyId, $userId);

    public function search($keywords);

    public function searchByCategory($category);

    public function searchWithCategory($search, $categories);

    public function getFeaturedProductCount($companyId = null);

    public function updateFeatured($value, $productId, $companyId = null);

    public function transferOwnerShip($companyId, $from, $to);

    public function updateOutOfStock($product_id, $out_of_stock, $company_id = null, $userId = null);

    public function removeProductSeller($company_id, $id);

    public function findByIdAndApproved($id);

    public function createTempProduct($data);

    public function findBySlugAndApproved($slug);

    public function findProductsBelow1500($number = 10);

    public function updateStock($id, $stock);
}
