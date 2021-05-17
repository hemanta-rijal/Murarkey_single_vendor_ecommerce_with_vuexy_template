<?php 
namespace Modules\Admin\Repositories;

use App\Models\ThemeSetting;
use Illuminate\Support\Facades\Cache;
use Modules\Admin\Contracts\ThemeSettingRepositoryInterface;

class DBThemeSettingRepository implements ThemeSettingRepositoryInterface
 {
     public function create($data){
          return ThemeSetting::create($data);
     }
    
    public function getPaginated($number){
        return ThemeSetting::paginate($number);
    }

    public function findById($id){
        return ThemeSetting::findOrFail($id);
    }

    public function update($id, $data){
        \Cache::forget('theme.'.$data['key']);
        return ['status' => $this->findById($id)->update($data)];
    }
    public function findByKey($key)
    {
        return ThemeSetting::findByKeyOrFail($key);
    }
    public function updateValue($key, $value)
    {
        \Cache::forget('theme.' . $key);
        return ThemeSetting::where('key', $key)->update(['value' => $value]);
    }

    public function delete( $id)
    {
        return ThemeSetting::destroy($id);
    }
 }