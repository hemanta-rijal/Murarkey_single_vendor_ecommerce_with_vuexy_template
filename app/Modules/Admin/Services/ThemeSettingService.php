<?php
namespace Modules\Admin\Services;

use Modules\Admin\Contracts\ThemeSettingServiceInterface;
use Modules\Admin\Repositories\DBThemeSettingRepository;

class ThemeSettingService implements ThemeSettingServiceInterface
{
     private $themeSettingRepository ;
     const  DEFAULT_PAGINATION = 10;

     public function __construct(DBThemeSettingRepository $dbThemeSettingRepository){
          $this->themeSettingRepository =  $dbThemeSettingRepository;
     }
     public function create($data){
          return $this->themeSettingRepository->create($data);
     }  
     public function getPaginated($number=null){
           return $this->themeSettingRepository->getPaginated(
                $this->getPaginationConstant($number)
           );
      }

     public function getPaginationConstant($number=null){
          return $number==null ? self::DEFAULT_PAGINATION : $number;
     }
     public function findById($id){

          return $this->themeSettingRepository->findById($id);
     }

     public function update($id, $data)
     {
          return $this->themeSettingRepository->update($id, $data);
     }
     public function delete($id){
          return $this->themeSettingRepository->delete($id);
     }

     public function findByKey($key)
    {
        return $this->themeSettingRepository->findByKey($key);
    }

    public function updateThemeSettings($data)
    {
        foreach ($data as $key => $value) {
            $this->themeSettingRepository->updateValue($key, $value);
        }
        return true;
    }

    
}
