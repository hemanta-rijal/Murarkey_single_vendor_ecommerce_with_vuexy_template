<?php


namespace Modules\Admin\Contracts;


use App\Models\SliderImage;

interface SliderRepository
{
    public function create(array $data): SliderImage;
    public function findById(int $id);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function getPaginated(int $number);
    public function getSlides();
    public function getSliderByPosition($position);

}