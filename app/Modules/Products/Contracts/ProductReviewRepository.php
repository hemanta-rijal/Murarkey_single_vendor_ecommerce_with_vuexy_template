<?php


namespace Modules\Products\Contracts;


interface ProductReviewRepository
{
    public function delete($id);

    public function findById($id);

    public function update($id, $data);

    public function create($data);

    public function canReview($id, $productId,$type);

    public function getReviewsInfo($productId);

    public function getLatestReviewsForProduct($productId);

}