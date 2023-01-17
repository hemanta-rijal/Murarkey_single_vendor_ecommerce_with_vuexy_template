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
        //social login
        route::post('google-login','AuthController@loginByGoogle');
        Route::post('forget-password', 'AuthController@sendResetLinkEmail');
        Route::post('sms-verify', 'AuthController@smsVerify');
        // Route::post('email-verify', 'AuthController@emailVerify');
        Route::post('password/pre-reset', 'AuthController@preForgetPassword');
        Route::post('password/reset', 'AuthController@reset');
        Route::post('pre-register', 'AuthController@preRegister');
        Route::get('esewa-verify', 'PaymentVerificationController@eSewaVerifyForProduct');
        Route::get('esewa-pid', 'PaymentVerificationController@storeEsewaPid');
    });

    /*pages */
    route::get('pages/policy/{slug}','PageController@getPolicyPage');
    /* pages ends here */

    /* menus */
    route::get('menuitem/{menu}','PageController@getMobileAppMenuArray');
    route::get('menu/{slug}','PageController@getMenuItem');
    /* end menus */

    route::post('paypal_transaction', 'BraintreeController@transaction');

    Route::get('categories', 'CategoriesController@index');
    Route::get('featured-categories', 'CategoriesController@getFeaturedCategories');
    Route::get('category/{id}', 'CategoriesController@getCategory');

    Route::get('slides', 'SlidesController@index');
    Route::get('slide/{id}', 'SlidesController@getSlide');

    //settings
    Route::get('payment_methods', 'SettingController@getPaymentMethods');
    Route::get('quick_facts', 'SettingController@quickFeature');
    route::get('countries', 'LocationController@country');

    //banners
    Route::get('all-banners/{position}', 'BannersController@getAllByPosition');
    Route::get('banners/{positon}', 'BannersController@getByPosition');

    //brands
    Route::get('featured-brands', 'BrandController@getFeaturedbrands');
    route::get('brands','BrandController@getBrandWithProductCount')->name('brands.get');

    //parlours
    Route::get('featured-parlours', 'ParlourController@getFeaturedParlours');
    route::get('parlours/{id}','ParlourController@show');

    Route::post('join-parlour-profession', 'JoinMurarkeyController@storeParlourProfession');

    Route::get('resize-image', 'ImageController@image');

  
    //product 
    Route::get('products', 'ProductsController@index');
    Route::get('products/{id}', 'ProductsController@show');
    Route::get('product_variant','ProductsController@getSkinAndProductNature');

    //search 
    Route::get('product/search', 'ProductsController@search');
    Route::get('services/search', 'ServiceController@search');

    //search ends
    Route::get('location-cities', 'LocationController@index');
    Route::resource('flash-sales', 'FlashSalesController');
    route::get('services', 'ServiceController@services');
    Route::get('servicecategory/get-tree', 'ServiceController@getTree');
    Route::get('/servicecategory/{category_id}/services', 'ServiceController@servicesByCategoryId');
    Route::get('/servicecagegory/toplevel','ServiceController@topLevelCategory');
    Route::get('/services', 'ServiceController@index');
    Route::get('/services/{id}', 'ServiceController@getById');
    Route::get('/popular-services', 'ServiceController@popularServices');
    Route::post('/convert-currency', 'AuthController@convertCurrency');
    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::post('me', 'AuthController@me');
        Route::post('/refresh', 'AuthController@refresh');
        Route::post('/my-account/update', 'AuthController@updateUser');
        Route::get('my-account/billing-details', 'AuthController@billingDetails')->name('user.billing-details');
        Route::post('my-account/billing-details', 'AuthController@updateBillingDetails')->name('user.billing-details.update');

        //change authenticated users password
        Route::post('password/change', 'AuthController@changePassword');

        Route::get('my-account/wallet', 'WalletController@index')->name('user.wallet');
        Route::post('my-account/wallet', 'AuthController@updateWallet')->name('user.wallet.update');
        route::get('my-account/wallet/total','AuthController@totalWalletAmount')->name('user.wallet.total');

        Route::get('my-account/shipment-details', 'AuthController@shipmentDetails')->name('user.shipment-details');
        Route::post('my-account/shipment-details', 'AuthController@updateShipmentDetails')->name('user.shipment-details.update');

        //profile pictures
        Route::post('/my-account/profile/upload-picture', 'AuthController@uploadProfilePic')->name('user.profile.upload-picture');
        Route::post('/my-account/profile/remove-picture', 'AuthController@removeProfilePic')->name('user.profile.remove-picture');

        Route::post('reviews', 'ReviewController@store');

        Route::post('can-review', 'ReviewController@canReview');

        Route::post('/user/auction-sales', 'AuctionSalesController@store');

        route::get('/checkout','CheckoutController@index');
        route::get('coupon', 'CheckoutController@applyCoupon');

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

        Route::post('user/order','MyOrdersController@store');

        Route::post('/user/my-orders/{orderId}', 'MyOrdersController@update');

        Route::post('user/my-orders/{orderId}/cancel', 'MyOrdersController@cancelOrder');

        Route::post('/user/discount/cart', 'DiscountController@forCart');

        Route::post('/user/discount/buy-now', 'DiscountController@forBuyNow');

        // Route::get('/user/my-auction-sales', 'AuctionSalesController@auctionSales');

        // Route::post('/user/my-auction-sales/{auctionSaleId}/change-status', 'AuctionSalesController@changeStatus');

        Route::post('/user/send-otp', 'OtpController@sendSms');

        Route::post('/user/verify-otp', 'OtpController@verifyOtp');

        Route::get('/paypal_payment', 'CheckoutController@paypalPayment');

        //esewa for wallet
        route::get('wallet_verify_esewa', 'WalletController@VerifyEsewa')->name('wallet.esewa.verify');

        // stats
//        route::get('stats')

    });
//    Route::fallback('ErrorController@fallback');

});
