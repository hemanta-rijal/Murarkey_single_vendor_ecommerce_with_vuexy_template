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
            if ($request->hasFile('fifth_ad_image')) {
                $data['fifth_ad_image'] = $request->fifth_ad_image->store('public/ads');
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
