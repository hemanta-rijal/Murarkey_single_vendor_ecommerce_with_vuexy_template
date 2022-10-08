<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PageController extends BaseController
{

    public function getPolicy($slug){
        $policy =null;
        switch ($slug) {
            case 'support-policy':
                $policy = get_meta_by_key('support_policy');
                break;

            case 'privacy-policy':
                $policy = get_meta_by_key('privacy_policy');
                break;

            case 'return-policy':
                $policy = get_meta_by_key('return_policy');
                break;
            case 'terms-and-condition':
                $policy = get_meta_by_key('terms_and_condition');
                break;

            case 'notice':
                $policy = get_meta_by_key('notice');
                break;
            case 'offer':
                $policy = get_meta_by_key('offer');
                break;
            default:
                $policy=null;
                break;
        }
        return $policy;
    }

    public function getPolicyPage($slug)
    {

        return response()->json(['data'=>$this->getPolicyPage($slug),'status'=>true],200);
      
    }

    public function getMobileAppMenuArray($menu){
        $menuItems = getMenuItemByType(get_theme_setting_by_key('top_header_menu'))->items;
        $itemsArray = [];
        $a = [];

        $itemsArray = $menuItems->map(function ($menuItems,$key) use($a){
            array_push($a,$menuItems->label,'test');
            return [
                'label'=>$menuItems->label,
                'type'=>$this->classifyHeaderMenuByClassName($menuItems->class),
                'class'=>$menuItems->class,
                'data'=>$this->returnDataOfMenuItem($menuItems)
            ];
        }) ;

        return response()->json($itemsArray);
    }

    public function getMenuItem($slug){
        $menu=null;
        switch ($slug){
            case 'notice':
                return response()->json([
                    'data'=>'test',
                    'video'=>[]
                ],200);
                break;
            case 'offer':
                return response()->json([
                    'data'=>'test2',
                    'video'=>[]
                ],200);
                break;
            case 'learn-to-book-parlour':
                return response()->json([
                    'data'=>'test3',
                    'video'=>[]
                ],200);
                break;
            case 'learn-to-book-home-services':
                return response()->json([
                    'data'=>'test4',
                    'video'=>[]
                ],200);
                break;
            case 'learn-to-shop':
                return response()->json([
                    'data'=>'test5',
                    'video'=>[]
                ],200);
                break;
            default:
                return response()->json([
                    'data'=>'',
                    'video'=>[]
                ],404);
        }

    }
    public function classifyHeaderMenuByClassName($classname){
        return  str_contains($classname,'video') ? 'video' :'data';
    }
    public function returnDataOfMenuItem($item){

        if (str_contains($item->class,'video')){
            return $item->link;
        }else{
            return $this->getPolicy(strtolower($item->label));
        }
    }
}