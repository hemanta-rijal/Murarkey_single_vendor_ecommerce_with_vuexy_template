<?php


namespace Modules\Admin\Contracts;


interface SliderService
{

    public function create(array $data, $image);
    public function update(int $id, array $data, $image);
    public function findById(int $id);
    public function delete(int $id);
    public function getPaginated(int $number = null);
    public function getPaginationConstant($number = null);
    public function getSlides();
}