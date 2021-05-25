<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('login', 'Auth\LoginController@showLoginForm')
        ->name('admin.login');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
        ->name('admin.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('login', 'Auth\LoginController@login');

    Route::group(['middleware' => 'admin'], function () {

        Route::get('users/export-csv', 'UsersController@exportCsv');

        Route::post('logout', 'Auth\LoginController@logout')
            ->name('admin.logout');
        Route::get('/', 'DashboardController@index')
            ->name('admin.dashboard');

        Route::get('/profile', 'Auth\LoginController@profile')
            ->name('admin.profile');

        Route::get('/profile/image-upload', 'Auth\LoginController@imageUpload')
            ->name('admin.profile.image-upload');

        Route::put('/profile', 'Auth\LoginController@postProfile')
            ->name('admin.post.profile');

        Route::post('/profile/upload-profile-pic', 'Auth\LoginController@uploadProfilePic')
            ->name('admin.upload-profile-pic');

        Route::post('/profile/remove-profile-pic', 'Auth\LoginController@removeProfilePic')
            ->name('admin.remove-profile-pic');

        /**
         *  there was route name "admin.profile" for
         * 1. "Auth\LoginController@profile" ,
         * 2. "Auth\LoginController@imageUpload"  and
         * 3. 'Auth\LoginController@postProfile'
         * I have chnged routes name of admin.profile.image-upload  from admin.profile
         * I have chnged routes name of admin.post.profile  from admin.profile
         * so we have to care about it later for impact of this to
         * a. profile image upload functions and controllers
         * b. profile post functions and controllers
         **/

        Route::post('/profile/re-position-profile-pic', 'Auth\LoginController@rePositionProfilePic')
            ->name('admin.reposition-profile-pic');

        Route::get('categories/order', 'CategoriesController@order');

        Route::post('categories/order', 'CategoriesController@storeOrder')
            ->name('admin.categories.order');

        Route::get('categories/upload', 'CategoriesController@uploadForm')
            ->name('admin.categories.upload');

        Route::post('categories/upload', 'CategoriesController@import')
            ->name('admin.categories.import');

        Route::resource('categories', 'CategoriesController', [
            'names' => [
                'index' => 'admin.categories.index',
                'create' => 'admin.categories.create',
                'store' => 'admin.categories.store',
                'show' => 'admin.categories.show',
                'update' => 'admin.categories.update',
                'edit' => 'admin.categories.edit',
                'destroy' => 'admin.categories.destroy',
            ],
        ]);

        Route::get('users/{id}/recover', 'UsersController@recover')
            ->name('admin.users.recover');

        Route::get('users/sellers/trash', 'UsersController@sellerTrash')
            ->name('admin.users.sellers-trash');

        Route::delete('users/{id}/delete-seller', 'UsersController@deleteSellerAccount')
            ->name('admin.users.seller-destroy');

        Route::get('users/trash', 'UsersController@trash')
            ->name('admin.users.trash');

        Route::get('users/{email}/forget-password', 'UsersController@sendResetEmail')
            ->name('admin.users.forget-password-email');

        Route::post('/users/bulk-delete', 'UsersController@bulkDelete');

        Route::resource('users', 'UsersController', [
            'names' => [
                'index' => 'admin.users.index',
                'create' => 'admin.users.create',
                'store' => 'admin.users.store',
                'show' => 'admin.users.show',
                'update' => 'admin.users.update',
                'edit' => 'admin.users.edit',
                'destroy' => 'admin.users.destroy',
            ],
        ]);

        Route::resource('metas', 'MetasController', [
            'names' => [
                'index' => 'admin.metas.index',
                'create' => 'admin.metas.create',
                'store' => 'admin.metas.store',
                'show' => 'admin.metas.show',
                'update' => 'admin.metas.update',
                'edit' => 'admin.metas.edit',
                'destroy' => 'admin.metas.destroy',
            ],
        ]);
        Route::resource('theme', 'ThemeSettingController', [
            'names' => [
                'index' => 'admin.theme.index',
                'create' => 'admin.theme.create',
                'store' => 'admin.theme.store',
                'show' => 'admin.theme.show',
                'update' => 'admin.theme.update',
                'edit' => 'admin.theme.edit',
                'destroy' => 'admin.theme.destroy',
            ],
        ]);

        Route::get('companies/{id}/update-status/{status}', 'CompaniesController@updateStatus')
            ->name('admin.companies.update-status');

        Route::get('companies/{id}/recover', 'CompaniesController@recover')
            ->name('admin.companies.recover');

        Route::get('companies/trash', 'CompaniesController@trash')
            ->name('admin.companies.trash');

        Route::resource('companies', 'CompaniesController', [
            'names' => [
                'index' => 'admin.companies.index',
                'create' => 'admin.companies.create',
                'store' => 'admin.companies.store',
                'show' => 'admin.companies.show',
                'update' => 'admin.companies.update',
                'edit' => 'admin.companies.edit',
                'destroy' => 'admin.companies.destroy',
            ],
            'except' => ['create', 'store'],
        ]);

        Route::resource('banners', 'BannersController', [
            'names' => [
                'index' => 'admin.banners.index',
                'create' => 'admin.banners.create',
                'store' => 'admin.banners.store',
                'show' => 'admin.banners.show',
                'update' => 'admin.banners.update',
                'edit' => 'admin.banners.edit',
                'destroy' => 'admin.banners.destroy',
            ],
        ]);
        Route::resource('sliders', 'SlidersController', [
            'names' => [
                'index' => 'admin.sliders.index',
                'create' => 'admin.sliders.create',
                'store' => 'admin.sliders.store',
                'show' => 'admin.sliders.show',
                'update' => 'admin.sliders.update',
                'edit' => 'admin.sliders.edit',
                'destroy' => 'admin.sliders.destroy',
            ],
        ]);

        Route::resource('pages', 'PagesController', [
            'names' => [
                'index' => 'admin.pages.index',
                'create' => 'admin.pages.create',
                'store' => 'admin.pages.store',
                'show' => 'admin.pages.show',
                'update' => 'admin.pages.update',
                'edit' => 'admin.pages.edit',
                'destroy' => 'admin.pages.destroy',
            ],
        ]);

        Route::resource('brands', 'BrandController', [
            'names' => [
                'index' => 'admin.brands.index',
                'create' => 'admin.brands.create',
                'store' => 'admin.brands.store',
                'show' => 'admin.brands.show',
                'update' => 'admin.brands.update',
                'edit' => 'admin.brands.edit',
                'destroy' => 'admin.brands.destroy',
            ],
        ]);

        Route::resource('home-page/featured-categories', 'Homepage\FeaturedCategoriesController', [
            'names' => [
                'index' => 'admin.featured-categories.index',
                'create' => 'admin.featured-categories.create',
                'store' => 'admin.featured-categories.store',
                'show' => 'admin.featured-categories.show',
                'update' => 'admin.featured-categories.update',
                'edit' => 'admin.featured-categories.edit',
                'destroy' => 'admin.featured-categories.destroy',
            ],
        ]);

        Route::resource('home-page/featured-companies', 'Homepage\FeaturedCompaniesController', [
            'names' => [
                'index' => 'admin.featured-companies.index',
                'create' => 'admin.featured-companies.create',
                'store' => 'admin.featured-companies.store',
                'show' => 'admin.featured-companies.show',
                'update' => 'admin.featured-companies.update',
                'edit' => 'admin.featured-companies.edit',
                'destroy' => 'admin.featured-companies.destroy',
            ],
        ]);

        Route::resource('flash-sales', 'FlashSalesController', [
            'names' => [
                'index' => 'admin.flash-sales.index',
                'create' => 'admin.flash-sales.create',
                'store' => 'admin.flash-sales.store',
                'show' => 'admin.flash-sales.show',
                'update' => 'admin.flash-sales.update',
                'edit' => 'admin.flash-sales.edit',
                'destroy' => 'admin.flash-sales.destroy',
            ],
        ]);
        Route::resource('discount-and-offers', 'FlashSalesController', [
            'names' => [
                'index' => 'admin.discount-and-offers.index',
                'create' => 'admin.discount-and-offers.create',
                'store' => 'admin.discount-and-offers.store',
                'show' => 'admin.discount-and-offers.show',
                'update' => 'admin.discount-and-offers.update',
                'edit' => 'admin.discount-and-offers.edit',
                'destroy' => 'admin.discount-and-offers.destroy',
            ],
        ]);

        Route::resource('system-messages', 'SystemMessageController', [
            'names' => [
                'index' => 'admin.system-messages.index',
                'create' => 'admin.system-messages.create',
                'store' => 'admin.system-messages.store',
                'show' => 'admin.system-messages.show',
                'update' => 'admin.system-messages.update',
                'edit' => 'admin.system-messages.edit',
                'destroy' => 'admin.system-messages.destroy',
            ],
        ]);

        Route::get('products/{id}/update-status/{status}', 'ProductsController@updateStatus')
            ->name('admin.products.update-status');

        Route::get('products/{id}/recover', 'ProductsController@recover')
            ->name('admin.products.recover');

        Route::get('products/trash', 'ProductsController@trash')
            ->name('admin.products.trash');

        Route::post('/products/ajax-search-with-category', 'ProductsController@ajaxSearchWithCategory');

        Route::post('/products/browsecategory/{id}', 'ProductsController@browseCategory');

        Route::post('/products/ajax-search', 'ProductsController@ajaxSearch');

        Route::resource('products', 'ProductsController', [
            'names' => [
                'index' => 'admin.products.index',
                'create' => 'admin.products.create',
                'store' => 'admin.products.store',
                'show' => 'admin.products.show',
                'update' => 'admin.products.update',
                'edit' => 'admin.products.edit',
                'destroy' => 'admin.products.destroy',
            ],
        ]);

        Route::resource('location/area-code', 'Location\AreaCodeController', [
            'names' => [
                'index' => 'admin.location.area-code.index',
                'create' => 'admin.location.area-code.create',
                'store' => 'admin.location.area-code.store',
                'show' => 'admin.location.area-code.show',
                'update' => 'admin.location.area-code.update',
                'edit' => 'admin.location.area-code.edit',
                'destroy' => 'admin.location.area-code.destroy',
            ],
        ]);

        Route::resource('location/cities', 'Location\CitiesController', [
            'names' => [
                'index' => 'admin.location.cities.index',
                'create' => 'admin.location.cities.create',
                'store' => 'admin.location.cities.store',
                'show' => 'admin.location.cities.show',
                'update' => 'admin.location.cities.update',
                'edit' => 'admin.location.cities.edit',
                'destroy' => 'admin.location.cities.destroy',
            ],
        ]);

        Route::resource('location/states', 'Location\StatesController', [
            'names' => [
                'index' => 'admin.location.states.index',
                'create' => 'admin.location.states.create',
                'store' => 'admin.location.states.store',
                'show' => 'admin.location.states.show',
                'update' => 'admin.location.states.update',
                'edit' => 'admin.location.states.edit',
                'destroy' => 'admin.location.states.destroy',
            ],
        ]);

        Route::resource('location/countries', 'Location\CountriesController', [
            'names' => [
                'index' => 'admin.location.countries.index',
                'create' => 'admin.location.countries.create',
                'store' => 'admin.location.countries.store',
                'show' => 'admin.location.countries.show',
                'update' => 'admin.location.countries.update',
                'edit' => 'admin.location.countries.edit',
                'destroy' => 'admin.location.countries.destroy',
            ],
        ]);

        Route::get('contact-us', 'PagesController@contactUsList');
        Route::get('contact-us/{id}', 'PagesController@contactUsShow');
        Route::get('contact-us/{id}/delete', 'PagesController@deleteContactUsData');
        Route::get('contact-us/update-status/{id}', 'PagesController@contactUsUpdateStatus');

        Route::get('system-settings', 'SiteSettingsController@index') //logos and system settings
            ->name('admin.system-settings.index');
            
            Route::post('system-settings', 'SiteSettingsController@update')
                ->name('admin.system-settings.update');
                
        Route::get('site-settings', 'SystemSettingsController@index')->name('admin.site-settings.index');  //homepage settings
        Route::post('site-settings', 'SystemSettingsController@update')->name('admin.site-settings.update');


        Route::get('newsletter/subscribers', 'NewsletterController@subscribers')
            ->name('admin.newsletter.subscribers');

        Route::get('newsletter/subscribers/{id}/delete', 'NewsletterController@deleteSubscriber');
    });
});
