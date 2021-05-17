<?php

Route::group(['prefix' => 'operator', 'namespace' => 'Operator'], function () {

    Route::get('login', 'Auth\LoginController@showLoginForm')
        ->name('operator.login');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
        ->name('operator.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('login', 'Auth\LoginController@login');

    Route::group(['middleware' => 'operator'], function () {
        Route::post('logout', 'Auth\LoginController@logout')
            ->name('operator.logout');

        Route::get('/profile', 'Auth\LoginController@profile')
            ->name('operator.profile');

//        Route::get('/', 'OrdersController@index')
//            ->name('operator.orders');




        Route::resource('/', 'OrdersDTController',[
            'names' => [
                'index' => 'operator.order-dt.index',
                'create' => 'operator.order-dt.create',
                'store' => 'operator.order-dt.store',
                'show' => 'operator.order-dt.show',
                'update' => 'operator.order-dt.update',
                'edit' => 'operator.order-dt.edit',
                'destroy' => 'operator.order-dt.destroy',
            ],
        ]);

        Route::resource('/not-found-awb', 'NotFoundAWBController',[
            'names' => [
                'index' => 'operator.not-found-awb.index',
                'create' => 'operator.not-found-awb.create',
                'store' => 'operator.not-found-awb.store',
                'show' => 'operator.not-found-awb.show',
                'update' => 'operator.not-found-awb.update',
                'edit' => 'operator.not-found-awb.edit',
                'destroy' => 'operator.not-found-awb.destroy',
            ],
        ]);



        Route::resource('/orders-operations', 'OrdersController', [
            'names' => [
                'index' => 'operator.orders.index',
                'create' => 'operator.orders.create',
                'store' => 'operator.orders.store',
                'show' => 'operator.orders.show',
                'update' => 'operator.orders.update',
                'edit' => 'operator.orders.edit',
                'destroy' => 'operator.orders.destroy',
            ],
        ]);


        Route::get('barcode', 'OrdersController@barcode');

//        Route::put('/profile', 'Auth\LoginController@postProfile')
//            ->name('admin.profile');
//
//        Route::post('/profile/upload-profile-pic', 'Auth\LoginController@uploadProfilePic')
//            ->name('admin.upload-profile-pic');
//
//        Route::post('/profile/remove-profile-pic', 'Auth\LoginController@removeProfilePic')
//            ->name('admin.remove-profile-pic');
//
//        Route::post('/profile/re-position-profile-pic', 'Auth\LoginController@rePositionProfilePic')
//            ->name('admin.reposition-profile-pic');
    });
});