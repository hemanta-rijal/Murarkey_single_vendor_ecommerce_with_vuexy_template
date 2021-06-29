<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManagerStatic;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::directive('role', function ($roles) {
            return "<?php if(role_match($roles)): ?>";
        });

        Blade::directive('endrole', function ($roles) {
            return "<?php endif; ?>";
        });

        Validator::extend('is_png', function ($attribute, $value, $params, $validator) {
            try {
                ImageManagerStatic::make($value);

                return true;
            } catch (\Exception $e) {
                return false;
            }
        });

        Validator::extend('old_password', function ($attribute, $value, $params, $validator) {
            return Hash::check($value, Auth::guard('web')->user()->password);
        });

        Validator::extend('user_exists', function ($attribute, $value, $params, $validator) {
            return User::where('email', $value)
                ->orWhere('phone_number', $value)->count() > 0;
        });

        Validator::extend('otp_verify_for_reset_password', function ($attribute, $value, $params, $validator) {
            return User::where(function ($q) use ($params) {
                $q->where('email', $params[0])->orWhere('phone_number', $params[0]);
            })->where('sms_verify_token', $value)->count() > 0;
        });

        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            // $this->app->register('Iber\Generator\ModelGeneratorProvider');
        }
    }
}
