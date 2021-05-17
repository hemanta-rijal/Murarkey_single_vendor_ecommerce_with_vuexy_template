<?php

namespace App\Http\Controllers\Admin;

use App\Models\ThemeSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Admin\Contracts\ThemeSettingServiceInterface;

class ThemeSettingController extends Controller
{
    protected $themeSettingService;

   function __construct(ThemeSettingServiceInterface $themeSettingService){
    $this->themeSettingService = $themeSettingService;
    }

    public function index()
    {
        $themes = $this->themeSettingService->getPaginated();
        return view('admin.themes.index', compact('themes'));  
    }

    public function create()
    {
        return view('admin.themes.create');
    }

    public function store(Request $request)
    {
        $data= $request->all();
        if( $this->themeSettingService->create($data)){
            flash('Theme setting added successfully', 'success');
            return redirect()->route('admin.theme.index');
        }
    }

    public function show($id)
    {
        $themeSetting = $this->themeSettingService->findById($id);

        return view('admin.themes.show', compact('themeSetting'));
    }
    public function edit($id)
    {
       $themeSetting = $this->themeSettingService->findById($id);
       return view('admin.themes.edit', compact('themeSetting'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        if($this->themeSettingService->update($id, $data)){
            flash('successfully updated');
            return redirect()->route('admin.theme.index');
        }
        
    }
    public function destroy($id)
    {
       $this->themeSettingService->delete($id);
        flash('Successfully deleted!');
        returnredirect()->route('admin.theme.index');
    }
}
