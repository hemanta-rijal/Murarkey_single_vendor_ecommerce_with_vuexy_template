<?php

namespace App\Http\Controllers\API\V1;

class PageController extends BaseController
{
    public function getPolicyPage($slug)
    {
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
                $policy = get_meta_by_key('notice');
                break;
            default:
                $policy=null;
                break;
        }
        return response()->json(['data'=>$policy,'status'=>true],200);
      
    }
}