<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Modules\Admin\Contracts\MetaService;

class SystemSettingsController extends Controller
{
    private $metaService;

    public function __construct(MetaService $metaService)
    {
        $this->metaService = $metaService;
    }
    public function index()
    {
        return view('admin.system-settings.index');
    }

    public function getSettingPages($slug)
    {
        try {
            return view('admin.system-settings.' . $slug);
        } catch (\Throwable $th) {
            $message = "Could Not Found The Related Page " . $th->getMessage();
            flash($message)->error();
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        try {
            if ($request->has(['mail_driver', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_address', 'mail_from_name'])) {
                $this->updateMailSetting($request);
            }

            $data = $request->except('_token');
            $this->metaService->updateSiteSettings($data);
            flash('Successfully updated!')->success();
            return redirect()->back();
        } catch (\Throwable $th) {
            $message = "Could Not Be Updated \n" . $th->getMessage();
            flash($message)->error();
            return redirect()->back();
        }
    }

    public function updateMailSetting(Request $request)
    {
        $this->updateDotEnv('MAIL_HOST', $request->mail_host);
        $this->updateDotEnv('MAIL_MAILER', $request->mail_driver);
        $this->updateDotEnv('MAIL_PORT', $request->mail_port);
        $this->updateDotEnv('MAIL_USERNAME', $request->mail_username);
        $this->updateDotEnv('MAIL_PASSWORD', $request->mail_password);
        $this->updateDotEnv('MAIL_ENCRYPTION', $request->mail_encryption);
        $this->updateDotEnv('MAIL_FROM_NAME', $request->mail_from_name);
        $this->updateDotEnv('MAIL_FROM_ADDRESS', $request->mail_from_address);
    }

    protected function updateDotEnv($key, $newValue)
    {
        Artisan::call('config:cache');
        Artisan::call('config:clear');

        $path = base_path('.env');
        $oldValue = env($key);
        // was there any change?
        // if ($oldValue === $newValue) {
        //     return;
        // }
        // overWriteEnvFile($key, $newValue);
        // rewrite file content with changed data

        // dd(file_get_contents($path));
        // dd($oldValue, $newValue);
        if (file_exists($path)) {
            // replace current value with new value
            file_put_contents(
                $path, str_replace(
                    $key . '=' . $oldValue,
                    $key . '=' . $newValue,
                    file_get_contents($path)
                )
            );
        }
    }

}
