<?php

namespace Modules\Products\Contracts;

interface ProductService
{
    public function create($data);

    public function getPaginated($type = null, $search = null, int $number = null, $companyId = null, $userId = null);

    public function getProductCountByStatus($type = null, $companyId = null, $userId = null);

    public function findById($id);

    public function findBySlug($slug);

    public function updateStatus($id, $status);

    public function delete($id, $force = null, $companyId = null, $userId = null);

    public function recover($id, $companyId = null, $userId = null);

    public function getTrashItems($companyId = null, $userId = null);

    public function update($id, $data);

    public function findByIdForSeller($id);

    public function updateForSeller($id, $data);

    public function copy($id, $companyId = null, $userId = null);

    public function emptyTrash($companyId, $userId);

    public function search($keywords, $category);

    public function searchWithCategory($search, $categoryId);

    public function updateFeatured($value, $productId, $companyId = null);

    public function searchBar();

    public function updateOutOfStock($product_id, $out_of_stock, $company_id = null, $userId = null);

    public function findByIdAndApproved($id);

    public function createTemp($data);

    public function findBySlugAndApproved($slug);

    public function updateStock($id, $stock);
}
