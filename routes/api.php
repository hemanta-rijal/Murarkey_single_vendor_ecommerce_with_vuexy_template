<?php
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
Route::group(['namespace' => 'API\V1'], function () {
    Route::group(['prefix' => 'auth'], function () {

        Route::post('refresh', 'AuthController@refresh');

        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('register', 'AuthController@register');
        Route::post('refresh', 'AuthController@refresh')->middleware('jwt.refresh');
        Route::post('resend-confirmation', 'AuthController@resendVerification');
        Route::post('forget-password', 'AuthController@sendResetLinkEmail');
        Route::post('sms-verify', 'AuthController@smsVerify');
        // Route::post('email-verify', 'AuthController@emailVerify');
        Route::post('password/pre-reset', 'AuthController@preForgetPassword');
        Route::post('password/reset', 'AuthController@reset');
        Route::post('pre-register', 'AuthController@preRegister');

    });

    Route::get('categories', 'CategoriesController@index');
    Route::get('featured-categories', 'CategoriesController@getFeaturedCategories');
    Route::get('category/{id}', 'CategoriesController@getCategory');

    Route::get('slides', 'SlidesController@index');
    Route::get('slide/{id}', 'SlidesController@getSlide');

    //settings
    Route::get('payment_methods', 'SettingController@getPaymentMethods');
    route::get('countries', 'LocationController@country');

    //banners
    Route::get('all-banners/{position}', 'BannersController@getAllByPosition');
    Route::get('banners/{positon}', 'BannersController@getByPosition');

    //brands
    Route::get('featured-brands', 'BrandController@getFeaturedbrands');

    //parlours
    Route::get('featured-parlours', 'ParlourController@getFeaturedParlours');

    Route::post('join-parlour-profession', 'JoinMurarkeyController@storeParlourProfession');

    // Route::get('companies', 'CompaniesController@index');
    // Route::get('companies/{companyId}', 'CompaniesController@show');
    // Route::get('companies/{companyId}/products', 'CompaniesController@products');

    Route::get('resize-image', 'ImageController@image');

    Route::get('products', 'ProductsController@index');
    Route::get('products/{id}', 'ProductsController@show');
    //search products
    Route::get('product/search', 'ProductsController@search');

    Route::get('location-cities', 'LocationController@index');

    Route::resource('flash-sales', 'FlashSalesController');
    route::get('services', 'ServiceController@services');
    Route::get('servicecategory/get-tree', 'ServiceController@getTree');
    Route::get('/servicecategory/{category_id}/services', 'ServiceController@servicesByCategoryId');
    Route::get('/services', 'ServiceController@index');
    Route::get('/services/{id}', 'ServiceController@getById');
    Route::get('/popular-services', 'ServiceController@popularServices');

    Route::group(['middleware' => ['jwt.verify']], function () {

        Route::post('me', 'AuthController@me');
        Route::post('/refresh', 'AuthController@refresh');

        Route::post('/my-account/update', 'AuthController@updateUser');
        Route::get('my-account/billing-details', 'AuthController@billingDetails')->name('user.billing-details');
        Route::post('my-account/billing-details', 'AuthController@updateBillingDetails')->name('user.billing-details.update');

        //change authenticated users password
        Route::post('password/change', 'AuthController@changePassword');

        Route::get('my-account/wallet', 'AuthController@wallet')->name('user.wallet');
        Route::post('my-account/wallet', 'AuthController@updateWallet')->name('user.wallet.update');

        Route::get('my-account/shipment-details', 'AuthController@shipmentDetails')->name('user.shipment-details');
        Route::post('my-account/shipment-details', 'AuthController@updateShipmentDetails')->name('user.shipment-details.update');

        //profile pictures
        Route::post('/my-account/profile/upload-picture', 'AuthController@uploadProfilePic')->name('user.profile.upload-picture');
        Route::post('/my-account/profile/remove-picture', 'AuthController@removeProfilePic')->name('user.profile.remove-picture');

        Route::post('reviews', 'ReviewController@store');

        Route::post('can-review', 'ReviewController@canReview');

        Route::post('/user/auction-sales', 'AuctionSalesController@store');

        Route::resource('cart', 'CartController');

        Route::post('/wishlist/proceedalltocart', 'WishlistController@proceedAllWishlistToCart');
        Route::post('/wishlist/proceedtocart/{rowId}', 'WishlistController@proceedWishlistToCart');

        Route::resource('wishlist', 'WishlistController');

        Route::post('wishlist/exists', 'WishlistController@productExists');

        // Route::post('/user/create-conversation', '\App\Http\Controllers\User\MessagesController@createConversation');
        // Route::post('/user/chat-data', '\App\Http\Controllers\User\MessagesController@getChatData');
        // Route::post('/user/store-message', '\App\Http\Controllers\User\MessagesController@storeMessage');
        // Route::post('/user/conversation/mark-as-read', '\App\Http\Controllers\User\MessagesController@markAsRead');
        // Route::post('/user/conversation/load-more', '\App\Http\Controllers\User\MessagesController@loadMore');
        // Route::post('/user/conversation/delete-message', '\App\Http\Controllers\User\MessagesController@deleteMessage');
        // Route::post('/user/conversation/hide', '\App\Http\Controllers\User\MessagesController@conversationHide');

        Route::post('/user/checkout-from-cart', 'CheckoutController@checkoutFromCart');
        Route::post('/user/checkout-from-buy-now', 'CheckoutController@checkoutFromBuyNow');

        Route::get('/user/my-orders', 'MyOrdersController@myOrders');
        Route::get('/user/my-orders/{order_id}/services', 'MyOrdersController@myOrdersServices');
        Route::get('/user/my-orders/{order_id}/products', 'MyOrdersController@myOrdersProducts');

        Route::post('/user/my-orders/{orderId}', 'MyOrdersController@update');

        Route::post('user/my-orders/{orderId}/cancel', 'MyOrdersController@cancelOrder');

        Route::post('/user/discount/cart', 'DiscountController@forCart');

        Route::post('/user/discount/buy-now', 'DiscountController@forBuyNow');

        // Route::get('/user/my-auction-sales', 'AuctionSalesController@auctionSales');

        // Route::post('/user/my-auction-sales/{auctionSaleId}/change-status', 'AuctionSalesController@changeStatus');

        Route::post('/user/send-otp', 'OtpController@sendSms');

        Route::post('/user/verify-otp', 'OtpController@verifyOtp');

        Route::get('/paypal_payment', 'CheckoutController@paypalPayment');

    });
//
    Route::fallback(function () {

        return response()->json([
            'data' => [],
            'success' => false,
            'status' => 404,
            'message' => 'Invalid Route',
        ]);
    });

});
