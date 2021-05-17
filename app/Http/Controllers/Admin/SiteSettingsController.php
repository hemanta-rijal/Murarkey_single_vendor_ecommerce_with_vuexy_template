<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Admin\Contracts\MetaService;
use Modules\Admin\Requests\UpdateSiteSettingsRequest;

class SiteSettingsController extends Controller
{
    private $metaService;

    public function __construct(MetaService $metaService)
    {
        $this->metaService = $metaService;
    }

    public function index()
    {
        return view('admin.site-settings.index');
    }

    public function update(UpdateSiteSettingsRequest $request)
    {
        $data = $request->except('_token');
        $logo = $request->logo;
        $this->metaService->updateSiteSettings($data, $logo);
        flash('Successfully updated!');

        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.system-settings.index');
    }
}
