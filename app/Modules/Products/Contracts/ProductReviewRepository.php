<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 9/27/18
 * Time: 3:59 PM
 */

namespace Modules\Products\Contracts;


interface ProductReviewRepository
{
    public function delete($id);

    public function findById($id);

    public function update($id, $data);

    public function create($data);

    public function canReview($id, $productId);

    public function getReviewsInfo($productId);

    public function getLatestReviewsForProduct($productId);

}