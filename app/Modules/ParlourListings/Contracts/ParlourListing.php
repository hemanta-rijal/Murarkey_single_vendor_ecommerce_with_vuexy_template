<?php


namespace Modules\ParlourListings\Contracts;

interface ParlourListing
{


    public function getAll();

    public function create($data,$image);

    public function findById($id);

    public function findBySlug($slug);

    public function getPaginated($type = null);

    public function updateStatus($id, $status);

    public function delete($id, $force = null, $reason = null);

    public function recover($id);

    public function getTrashItems();

    public function findBySlugAndApproved($slug);
}