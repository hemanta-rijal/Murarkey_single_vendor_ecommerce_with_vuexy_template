<?php


namespace Modules\Admin\Repositories;


use App\Models\SliderImage;
use Modules\Admin\Contracts\SliderRepository;

class DbSliderRepository implements SliderRepository
{
    public function create(array $data) : SliderImage {
        return SliderImage::create($data);
    }

    public function findById(int $id) {
        return SliderImage::findOrFail($id);
    }

    public function update(int $id, array $data) {
        return ['status' => $this->findById($id)->update($data)];
    }

    public function delete(int $id) {
        return SliderImage::destroy($id);
    }

    public function getPaginated(int $number) {
        return SliderImage::paginate($number);
    }

    public function getSlides()
    {
        return SliderImage::orderBy('weight', 'DESC')->get();
    }
    public function getSliderByPosition($position){
        return SliderImage::where('slug',$position)->orderBy('weight','DESC')->get();
    }

}