<?php

namespace Modules\Service\Contracts;

interface ServiceRepository
{
    public function findById($id);
    public function findBySlug($slug);
    public function getAll();
    public function getPopularServices();
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function getMurarkeyService();
    public function getParlourService();
    public function getParlourServicesNotAssignedToParlor();
    public function findBy($column, $data);
    public function getBy($column, $data);
    public function deleteServiceImage($imageId);
    public function addImages($data,$product);
    public function getByListOfCategory($array);
}
