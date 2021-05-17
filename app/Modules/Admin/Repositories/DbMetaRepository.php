<?php
namespace Modules\Admin\Repositories;

use App\Models\Meta;
use Modules\Admin\Contracts\MetaRepository;

class DbMetaRepository implements MetaRepository
{
    public function create(array $data): Meta
    {
        return Meta::create($data);
    }

    public function findById(int $id)
    {
        return Meta::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        \Cache::forget('meta.' . $data['key']);
        return ['status' => $this->findById($id)->update($data)];
    }

    public function delete(int $id)
    {
        return Meta::destroy($id);
    }

    public function getPaginated(int $number)
    {
        return Meta::paginate($number);
    }

    public function findByKey($key)
    {
        return Meta::findByKeyOrFail($key);
    }

    public function updateValue($key, $value)
    {
        \Cache::forget('meta.' . $key);

        return Meta::where('key', $key)->update(['value' => $value]);
    }
}
