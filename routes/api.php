<?php

$api = app('Dingo\Api\Routing\Router');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

$api->version('v1', ['namespace' => 'App\Http\Controllers\API\V1'], function ($api) {
    $api->group(['prefix' => 'auth'], function ($api) {

        $api->post('refresh', 'AuthController@refresh');
        $api->post('me', 'AuthController@me');
        $api->post('login', 'AuthController@login');
        $api->post('logout', 'AuthController@logout');
        $api->post('register', 'AuthController@register');
        $api->post('refresh', 'AuthController@refresh')->middleware('jwt.refresh');
        $api->post('resend-confirmation', 'AuthController@resendVerification');
        $api->post('forget-password', 'AuthController@sendResetLinkEmail');
        $api->post('sms-verify', 'AuthController@smsVerify');
        // $api->post('email-verify', 'AuthController@emailVerify');
        $api->post('password/pre-reset', 'AuthController@preForgetPassword');
        $api->post('password/reset', 'AuthController@reset');
        $api->post('pre-register', 'AuthController@preRegister');
    });

    $api->get('categories', 'CategoriesController@index');
    $api->get('category/{id}', 'CategoriesController@getCategory');

    $api->get('slides', 'SlidesController@index');
    $api->get('slide/{id}', 'SlidesController@getSlide');

    // $api->get('companies', 'CompaniesController@index');
    // $api->get('companies/{companyId}', 'CompaniesController@show');
    // $api->get('companies/{companyId}/products', 'CompaniesController@products');

    $api->get('resize-image', 'ImageController@image');

    $api->get('products', 'ProductsController@index');
    $api->get('products/{id}', 'ProductsController@show');
    $api->get('location-cities', 'LocationController@index');

    $api->resource('flash-sales', 'FlashSalesController');

    $api->group(['middleware' => 'api.auth'], function ($api) {

        $api->post('reviews', 'ReviewController@store');

        $api->post('can-review', 'ReviewController@canReview');

        $api->post('/user/auction-sales', 'AuctionSalesController@store');

        $api->resource('cart', 'CartController');

        $api->resource('wishlist', 'WishlistController');

        $api->post('wishlist/exists', 'WishlistController@productExists');

        $api->post('/user/create-conversation', '\App\Http\Controllers\User\MessagesController@createConversation');
        $api->post('/user/chat-data', '\App\Http\Controllers\User\MessagesController@getChatData');
        $api->post('/user/store-message', '\App\Http\Controllers\User\MessagesController@storeMessage');
        $api->post('/user/conversation/mark-as-read', '\App\Http\Controllers\User\MessagesController@markAsRead');
        $api->post('/user/conversation/load-more', '\App\Http\Controllers\User\MessagesController@loadMore');
        $api->post('/user/conversation/delete-message', '\App\Http\Controllers\User\MessagesController@deleteMessage');
        $api->post('/user/conversation/hide', '\App\Http\Controllers\User\MessagesController@conversationHide');

        $api->post('/user/checkout-from-cart', 'CheckoutController@checkoutFromCart');
        $api->post('/user/checkout-from-buy-now', 'CheckoutController@checkoutFromBuyNow');

        $api->get('/user/my-orders', 'MyOrdersController@index');

        $api->post('/user/my-orders/{orderId}', 'MyOrdersController@update');

        $api->post('user/my-orders/{orderId}/cancel', 'MyOrdersController@cancelOrder');

        $api->post('/user/discount/cart', 'DiscountController@forCart');

        $api->post('/user/discount/buy-now', 'DiscountController@forBuyNow');

        $api->get('/user/my-auction-sales', 'AuctionSalesController@auctionSales');

        $api->post('/user/my-auction-sales/{auctionSaleId}/change-status', 'AuctionSalesController@changeStatus');

        $api->post('/user/send-otp', 'OtpController@sendSms');

        $api->post('/user/verify-otp', 'OtpController@verifyOtp');
    });

    Route::fallback(function () {
        return response()->json([
            'data' => [],
            'success' => false,
            'status' => 404,
            'message' => 'Invalid Route',
        ]);
    });

});
