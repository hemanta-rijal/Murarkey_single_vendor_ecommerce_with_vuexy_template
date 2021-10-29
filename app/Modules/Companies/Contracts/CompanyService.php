<?php


namespace Modules\Companies\Contracts;


interface CompanyService
{
    public function uploadImage($name, $file, $id = null);

    public function updateLogoPhotos($data, $id = null);

    public function removeImage($image, $id = null);

    public function findById($id);

    public function findBySlug($slug);

    public function getPaginated($type = null);

    public function getCountOfCompanies($type = null);

    public function updateByAdmin($id, $data, $companyFiles, $images);

    public function updateStatus($id, $status);

    public function delete($id, $force = null, $reason = null);

    public function recover($id);

    public function getTrashItems();

    public function searchBar();

    public function findBySlugAndApproved($slug);
}