<?php

namespace Modules\Admin\Repositories;

use App\Models\Banner;
use Modules\Admin\Contracts\BannerRepository;

class DbBannerRepository implements BannerRepository
{
    public function create(array $data): Banner
    {
        \Cache::forget('banner.' . $data['type']);

        return Banner::create($data);
    }

    public function findById(int $id)
    {
        return Banner::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        \Cache::forget('banner.' . $data['type']);
        return ['status' => $this->findById($id)->update($data)];
    }

    public function delete(int $id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        \Cache::forget('banner.' . $banner->type);
        return $banner->delete();
    }

    public function getPaginated(int $number)
    {
        return Banner::paginate($number);
    }

    public function findByKey($key)
    {
        return Banner::findByKeyOrFail($key);
    }

    public function findByPosition($position)
    {
        return Banner::wherePosition($position)->get();
    }
    public function findAllByPosition($position)
    {
        return Banner::findAllByPosition($position);
    }

}
