<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Admin\Requests\UpdateSiteSettingsRequest;
use Modules\Admin\Services\ThemeSettingService;
use Throwable;

class SiteSettingsController extends Controller
{
    private $themeSettingService;

    public function __construct(ThemeSettingService $themeSettingService)
    {
        $this->themeSettingService = $themeSettingService;
    }

    public function update(UpdateSiteSettingsRequest $request)
    {
        try {
            $data = $request->except('_token');
            // home page ads setting
            if ($request->hasFile('first_ad_image')) {
                $data['first_ad_image'] = $request->first_ad_image->store('public/ads');
            };
            if ($request->hasFile('second_ad_image')) {
                $data['second_ad_image'] = $request->second_ad_image->store('public/ads');
            };
            if ($request->hasFile('third_ad_image')) {
                $data['third_ad_image'] = $request->third_ad_image->store('public/ads');
            };
            if ($request->hasFile('fourth_ad_image')) {
                $data['fourth_ad_image'] = $request->fourth_ad_image->store('public/ads');
            };
            //skin tone settings
            if ($request->hasFile('normal_skin_image')) {
                $data['normal_skin_image'] = $request->normal_skin_image->store('public/skin-tone');
            };
            if ($request->hasFile('dry_skin_image')) {
                $data['dry_skin_image'] = $request->dry_skin_image->store('public/skin-tone');
            };
            if ($request->hasFile('oily_skin_image')) {
                $data['oily_skin_image'] = $request->oily_skin_image->store('public/skin-tone');
            };

            if ($this->themeSettingService->updateThemeSettings($data)) {
                flash('successfully updated')->success();
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            $message = "Could Not Be Updated \n" . $th->getMessage();
            flash($message)->error();
            return redirect()->back();
        }
    }
}
