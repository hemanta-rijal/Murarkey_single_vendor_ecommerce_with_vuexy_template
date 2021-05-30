<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Admin\Contracts\MetaService;

class SystemSettingsController extends Controller
{
    private $metaService;

    public function __construct(MetaService $metaService)
    {
        $this->metaService = $metaService;
    }
    public function index(){
        return view('admin.system-settings.index');
    }

    public function getSettingPages($slug){
        try {
            return view('admin.system-settings.'.$slug);
        } catch (\Throwable $th) {
            $message="Could Not Found The Related Page ".$th->getMessage();
            flash($message)->error();
            return redirect()->back();
        }
    }

    public function update(Request $request){
        try {
               $data = $request->except('_token');
                $logo = $request->logo;
                $this->metaService->updateSiteSettings($data, $logo);
                flash('Successfully updated!')->success();
                return redirect()->back();
            } catch (\Throwable $th) {
                $message="Could Not Be Updated \n".$th->getMessage();
                flash($message)->error();
                return redirect()->back();
            }
    }
    
}
