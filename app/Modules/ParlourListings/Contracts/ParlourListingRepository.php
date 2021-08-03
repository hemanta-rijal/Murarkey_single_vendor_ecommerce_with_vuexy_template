<?php

namespace Modules\ParlourListings\Contracts;

interface ParlourListingRepository
{
    public function create($data);

    public function update($id, $data);

    public function getAll();

    public function getAllFeatured();

    public function getAllActive();

    public function findById($id);

    public function findBySlug($slug);

    public function getPaginated($type = null);

    public function getTrashedItemById($id);

    public function getTrashItems();

    public function search($keywords);

    public function findBySlugAndApproved($slug);

    public function getFeatureListing();
}
