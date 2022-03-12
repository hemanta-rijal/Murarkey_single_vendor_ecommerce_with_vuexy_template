<?php

namespace Modules\Service\Contracts;

interface ServiceService
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
    public function deleteServiceImage($image_id);
    public function addImages($data,$service);

}
