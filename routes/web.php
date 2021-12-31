<?php

// Route::get('/cache-clear', function () {
//     Artisan::call('config:clear');
//     Artisan::call('cache:clear');
//     Artisan::call('route:clear');
//     Artisan::call('view:clear');
//     return "Cache is cleared";
// });
// Route::get('/meta-seeder', function () {
//     Artisan::call('db:seed --class=SiteSettingsSeeder');
//     return "Meta seeded";
// });
// Route::get('/admin-seeder', function () {
//     Artisan::call('db:seed --class=AdminUserSeeder');
//     return "Admin User seeded with permissiontable and role table";
// });
// Route::get('/migrate-fresh', function () {
//     Artisan::call('migrate:fresh');
//     return "Migration freshed";
// });
// Route::get('/storage-link', function () {
//     Artisan::call('storage:link');
//     return "sorate linked";
// });

Route::get('/', 'HomeController@index')
    ->name('home');

// Authentication Routes...
Route::get('auth/login', 'Auth\LoginController@showLoginForm')
    ->name('login');

Route::post('auth/login', 'Auth\LoginController@login')->name('auth.login');
Route::get('auth/logout', 'Auth\LoginController@logout')
    ->name('logout');

Route::get('auth/resend-verification/{email}', 'Auth\LoginController@resendVerification');

// Route::post('auth/pre-register', 'Auth\RegisterController@preRegister');

Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm')
    ->name('register');
//
Route::post('auth/register', 'Auth\RegisterController@register')->name('auth.register');

Route::get('auth/verify/{token}', 'Auth\RegisterController@verify')
    ->name('auth.verify');

Route::get('auth/verify-and-reset/{token}', 'Auth\RegisterController@verifyAndReset')
    ->name('auth.verify-and-reset');

Route::get('auth/sms-verify', 'Auth\SmsVerifyController@index')
    ->name('auth.sms-verify.get');

Route::post('auth/sms-verify', 'Auth\SmsVerifyController@store')
    ->name('auth.sms-verify');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('forget-password.form');

Route::post('password/pre-reset', 'Auth\ForgotPasswordController@preForgetPassword')->name('pre-forget-password.post');

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('send-reset-link');

Route::post('password/reset', 'Auth\ResetPasswordController@reset')
    ->name('password.reset');

Route::post('/user/verify-otp', 'User\OtpController@verifyOtp')
    ->name('user.verify-otp');

// Route::get('auth/facebook', 'Auth\LoginController@redirectToProvider')
//     ->name('facebook.login');
// Route::get('auth/facebook/callback', 'Auth\LoginController@handleProviderCallback')
//     ->name('facebook.callback');

Route::get('login/{provider}', 'Auth\LoginController@redirect');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function () {

    Route::get('user', 'UserController@dashboard')
        ->name('user.dashboard');

    Route::get('/user/my-account/user-info', 'UserController@userInfo')->name('user.my-account');
    Route::get('/user/my-account/user-info/edit', 'UserController@editUserInfo')->name('user.edit-profile');
    Route::get('/user/my-account/user-info/update-password', 'UserController@getUpdatePassword')->name('user.update-password');

    Route::get('/user/my-account/shipment-info', 'UserController@shipmentInfo')->name('user.my-account.shipment-info');
    Route::get('/user/my-account/shipment-info/edit', 'UserController@editShipmentInfo')->name('user.my-account.shipment-info.edit');

    Route::get('/user/my-account/billing-info', 'UserController@billingInfo')->name('user.my-account.billing-info');
    Route::get('/user/my-account/billing-info/edit', 'UserController@editBillingInfo')->name('user.my-account.billing-info.edit');

    Route::get('/user/my-account/wallet', 'UserController@wallet')->name('user.my-account.wallet');
    Route::post('/user/my-account/load/wallet', 'User\WalletController@store')->name('user.my-account.load-wallet');

    Route::get('/user/my-account/seller-info', 'UserController@sellerInfo')
        ->middleware('seller');
    Route::get('/user/my-account/seller-info/edit', 'UserController@editSellerInfo')
        ->middleware('seller');

    Route::get('/user/my-account/company-info', 'UserController@companyInfo')
        ->middleware('just-main-seller');

    Route::get('/user/my-account/company-info/edit', 'UserController@editCompanyInfo')
        ->middleware('just-main-seller');

    Route::get('/user/create-seller-company', 'UserController@createSellerCompany')
        ->middleware('role:ordinary-user');

    Route::get('/user/my-account/change-password', 'UserController@changePassword')->name('user.change-password.form');
    Route::put('/user/my-account/change-password', 'UserController@updatePassword')->name('user.change-password.update');
    Route::get('/user/my-account/settings', 'UserController@accountSettings');

    Route::delete('/user/my-account/close-company', 'UserController@closeCompany')
        ->middleware('just-main-seller');
    Route::delete('/user/my-account/close-seller-account', 'UserController@closeSellerAccount')
        ->middleware('role:associate-seller');
    Route::delete('/user/my-account/close-user-account', 'UserController@closeUserAccount');

    Route::put('/user/my-account/user-info', 'UserController@updateUserInfo')->name('update.user-info');
    Route::put('/user/my-account/shipment-info', 'UserController@updateShipmentInfo')->name('update.shipment-detail');
    Route::put('/user/my-account/billing-info', 'UserController@updateBillingInfo')->name('update.billing-detail');

    Route::put('/user/my-account/seller-info', 'UserController@updateSellerInfo')
        ->middleware('seller');

    Route::put('/user/my-account/company-info', 'UserController@updateCompanyInfo')
        ->middleware('just-main-seller');

    Route::post('/user/create-seller-company', 'UserController@storeSellerCompany')
        ->middleware('role:ordinary-user');

    Route::post('/user/upload-profile-pic', 'UserController@uploadProfilePic')
        ->middleware('fix-orientation')
        ->name('user.upload-profile-pic');

    Route::post('/user/base64-upload-profile-pic', 'UserController@base64UploadImage')
        ->name('user.profile-pic.bas64-image-upload');

    Route::post('/user/remove-profile-pic', 'UserController@removeProfilePic')
        ->name('user.remove-profile-pic');

    Route::post('/user/re-position-profile-pic', 'UserController@rePositionProfilePic')
        ->name('user.reposition-profile-pic');

    Route::group(['namespace' => 'User'], function () {

        Route::post('/user/send-otp', 'OtpController@sendSms')
            ->name('user.send-otp');

        Route::get('/user/company/logo-photos', 'CompanyController@logoPhotos')
            ->middleware('role:main-seller');
        Route::get('/user/company/logo-photos/edit', 'CompanyController@editLogoPhotos')
            ->middleware('role:main-seller');
        Route::get('/user/company/product-showcase', 'CompanyController@productShowcase')
            ->middleware('role:main-seller');

        Route::put('/user/company/product-showcase', 'CompanyController@updateProductShowcase')
            ->middleware('role:main-seller');

        Route::post('/user/company/image-upload', 'CompanyController@uploadImage')
            ->name('user.company.image-upload')
            ->middleware(['role:main-seller', 'fix-orientation']);

        Route::post('/user/company/base64-image-upload', 'CompanyController@base64UploadImage')
            ->name('user.company.bas64-image-upload')
            ->middleware('role:main-seller');

        Route::post('/user/company/logo-photos', 'CompanyController@updateLogoPhotos')
            ->middleware('role:main-seller');

        Route::get('/user/company/logo-photos/remove/{id}', 'CompanyController@removeImage')
            ->middleware('role:main-seller');

        Route::get('/user/products/{id}/recover', 'ProductsController@recover')
            ->name('user.products.recover');

        Route::post('/user/products/{id}/copy', 'ProductsController@copy')
            ->name('user.products.copy');

        Route::get('/user/products/trash', 'ProductsController@trash')
            ->name('user.products.trash');

        Route::put('/user/products/update-out-of-stock', 'ProductsController@updateOutOfStock');

        Route::delete('/user/products', 'ProductsController@deleteMultiple');

        Route::delete('products/empty-trash', 'ProductsController@emptyTrash')
            ->name('user.products.empty-trash');

        Route::resource('/user/products', 'ProductsController', [
            'names' => [
                'index' => 'user.products.index',
                'create' => 'user.products.create',
                'store' => 'user.products.store',
                'update' => 'user.products.update',
                'edit' => 'user.products.edit',
                'destroy' => 'user.products.destroy',
            ],
            'except' => 'show',
            'middleware' => 'seller',
        ]);

        Route::match(['PUT', 'POST'], '/user/temp-products', 'ProductsController@storingTempProduct')
            ->middleware('seller');

        Route::get('user/temp-products/{id}/preview', 'ProductsController@tempPreview')
            ->name('user.temp-product-preview')
            ->middleware('seller');
        //Associate Sellers
        Route::get('user/associate-sellers', 'AssociateSellersController@myAssociateSellers')
            ->middleware('role:main-seller');

        Route::get('user/associate-sellers/invited-associates', 'AssociateSellersController@invitedAssociates')
            ->middleware('role:main-seller');

        Route::get('user/associate-sellers/invite-new', 'AssociateSellersController@inviteNew')
            ->middleware('role:main-seller');

        Route::post('/user/associate-sellers/invite-new', 'AssociateSellersController@postInviteNew');
        Route::post('/user/associate-sellers/cancel-invitation', 'AssociateSellersController@cancelInvitation');
        Route::delete('/user/associate-sellers/remove-associate/{id}', 'AssociateSellersController@removeCompanyAssociateSeller');

        //Message Center
        //Inbox ho hai
        Route::get('user/message-center/conversations', 'MessageCenterController@conversations')
            ->name('user.message-center.conversations');

        Route::post('user/message-center/conversations', 'MessageCenterController@postConversations');

        Route::get('user/message-center/conversation/{id}', 'MessageCenterController@conversation');

        Route::delete('user/message-center/conversation/{id}', 'MessageCenterController@deleteConversation');

        Route::put('user/message-center/conversation/{id}', 'MessageCenterController@updateConversation');

        Route::get('user/message-center/system-news', 'MessageCenterController@systemNews')
            ->name('user.message-center.system-news');

        Route::get('user/message-center/system-news/{id}', 'MessageCenterController@singleSystemNews')
            ->name('user.message-center.single-system-news');

        Route::put('user/message-center/system-news/{id}', 'MessageCenterController@updateSingleSystemNews');

        Route::get('user/message-center/sent-messages', 'MessageCenterController@sentMessages')
            ->name('user.message-center.sent-messages');

        Route::get('user/message-center/trash', 'MessageCenterController@trash')
            ->name('user.message-center.trash');

        Route::get('user/message-center/invite-requests', 'MessageCenterController@inviteRequests')
            ->name('user.message-center.invite-requests')
            ->middleware('role:associate-seller|ordinary-user');

        Route::post('/user/message-center/mark-all-invitation-as-read', 'MessageCenterController@markAllInvitationAsRead');

        Route::post('/user/message-center/accept-invitation', 'MessageCenterController@acceptInvitation')
            ->middleware('role:ordinary-user');

        Route::post('/user/message-center/delete-invitation', 'MessageCenterController@deleteInvitation')
            ->middleware('role:associate-seller|ordinary-user');

        // Chat
        Route::post('/user/create-conversation', 'MessagesController@createConversation');
        Route::post('/user/chat-data', 'MessagesController@getChatData');
        Route::post('/user/store-message', 'MessagesController@storeMessage');
        Route::post('/user/conversation/mark-as-read', 'MessagesController@markAsRead');
        Route::post('/user/conversation/load-more', 'MessagesController@loadMore');
        Route::post('/user/conversation/delete-message', 'MessagesController@deleteMessage');

        Route::post('/user/conversation/hide', 'MessagesController@conversationHide');

        Route::post('/user/review', 'ReviewController@store')->name('user.reviews.store');

        Route::resource('/user/cart', 'CartController', [
            'names' => [
                'index' => 'user.cart.index',
                'create' => 'user.cart.create',
                'store' => 'user.cart.store',
                'update' => 'user.cart.update',
                'edit' => 'user.cart.edit',
                'destroy' => 'user.cart.destroy',
            ],
        ])->except('show');
        Route::post('/user/carts/update', 'CartController@updateCartContents')->name('user.carts-content.update');

        Route::resource('/user/wishlist', 'WishlistController', [
            'names' => [
                'index' => 'user.wishlist.index',
                'create' => 'user.wishlist.create',
                'store' => 'user.wishlist.store',
                'update' => 'user.wishlist.update',
                'edit' => 'user.wishlist.edit',
                'destroy' => 'user.wishlist.destroy',
            ],

            'only' => [
                'index',
                'store',
                'update',
                'destroy',
            ],
        ]);

        Route::resource('/user/orders', 'OrdersController', [
            'names' => [
                'index' => 'user.orders.index',
                'update' => 'user.orders.update',
                'store' => 'user.orders.store',
                'show' => 'user.orders.show',
            ],
            // 'only' => ['index', 'update', 'store', 'show'],
        ]);
        Route::get('/user/orders/{order_id}/download-summary', 'OrdersController@downloadPdf');
        Route::put('/user/orders/{orderId}/seller-info', 'OrdersController@updateSellerInfo')
            ->name('user.orders.seller-info');

        Route::resource('/user/reports', 'ReportsController', [
            'names' => [
                'store' => 'user.reports.store',
            ],
            'only' => ['store'],
        ])->middleware('role:main-seller');

        Route::resource('/user/checkout', 'CheckoutController', [
            'names' => [
                'index' => 'user.checkout.index',
                'create' => 'user.checkout.create',
                'store' => 'user.checkout.store',
                'update' => 'user.checkout.update',
                'edit' => 'user.checkout.edit',
                'destroy' => 'user.checkout.destroy',
            ],
        ]);

        route::get('coupon','CheckoutController@applyCoupon')->name('coupon.apply');

        Route::resource('user/my-orders', 'MyOrdersController', [
            'names' => [
                'index' => 'user.my-orders.index',
                'update' => 'user.my-orders.update',
            ],
            'only' => ['index', 'update'],
        ]);

        Route::post('user/my-orders/{orderId}/change-status', 'MyOrdersController@changeStatus')
            ->name('user.my-orders.change-status');

    });

    //cart
    Route::get('cart/dropdownlist', 'User\CartController@getCartDropDown')->name('cart.dropdownlist');
    Route::get('cart/count', 'User\CartController@getCartCountData')->name('cart.count');
    route::get('cart', 'User\CheckoutController@getCheckoutView')->name('cart.checkout');
//wishlist
    Route::get('wishlist/dropdownlist', 'User\WishlistController@getWishlistDropDown')->name('wishlist.dropdownlist');
    Route::get('wishlist/count', 'User\WishlistController@getWishlistCountData')->name('wishlist.count');
    route::get('wishlist', 'User\WishlistController@getWishlistView')->name('wishlist.view');
    route::post('wishlist/update-to-cart', 'User\WishlistController@upDateToCart')->name('user.wishlist.updatetocart');

});

Route::group(['middleware' => 'only-auth'], function () {
    Route::any('/user/products/image-upload/{name}', 'User\ProductsController@imageUpload')
        ->middleware('fix-orientation')
        ->name('user.products.image-upload');
});
//parlour
Route::get('/parlour/{slug}', 'ParlourController@parlourInfo')->name('parlourInfo');
Route::get('/parlours', 'ParlourController@parlourPage')->name('parlour.index');

//brands
route::get('brands','BrandController@getBrandsByProductSize')->name('brands.all');

//profession
Route::get('parlour-profession', 'JoinMurarkeyController@parlourProfession')->name('parlour-profession');
Route::get('join-parlour-profession', 'JoinMurarkeyController@joinparlourProfessionForm')->name('get.join-profession');
Route::post('join-parlour-profession', 'JoinMurarkeyController@storeParlourProfession')->name('post.join-profession');

//
Route::post('location-info', 'LocationController@getInfo');
//
Route::post('location-info/area-code', 'LocationController@getAreaCode');
//

Route::get('pages/contact-us', 'PageController@getContactUsePage')->name('page.contact-us');
Route::get('pages/{slug}', 'PageController@show')->name('pages.show');
Route::post('pages/contact-us', 'PageController@postContactUsForm')->name('post.contact-us');

Route::get('categories', 'CategoriesController@index');

Route::post('categories/get-children', 'CategoriesController@getChildren');

// Route::get('companies/search', 'CompaniesController@search');

Route::get('companies/{slug}/products', 'CompaniesController@showProducts')
    ->name('companies.products');

Route::get('companies/{slug}/info', 'CompaniesController@showInfo')
    ->name('companies.info');

Route::get('companies/{slug}/contact', 'CompaniesController@showContact')
    ->name('companies.contact');

Route::post('companies/{slug}/contact', 'CompaniesController@postContact');

Route::get('companies/{slug}', 'CompaniesController@show')
    ->name('companies.show');

Route::get('products/search', 'ProductsController@search')
    ->name('products.search');

Route::post('products/autocomplete/search', 'PageController@autocompleteSearch')
    ->name('products.autocomplete.search');

Route::get('products/{slug}', 'ProductsController@show')
    ->name('products.show');

Route::get('/flashsales', 'FlashSalesController@index')
    ->name('flashsales.index');

Route::post('newsletter/add-subscriber', 'NewsletterController@addSubscriber')
    ->name('newsletter.add-subscriber');

Route::get('auction-sales/running', 'AuctionSalesController@running');

Route::get('auction-sales/coming-soon', 'AuctionSalesController@comingSoon');

// khalti payment integration
Route::post('payment/verification', 'PaymentController@verification');

//esewa
route::post('load_esewa_payment_option', 'User\PaymentVerificationController@loadPayWithEsewaOption')->name('esewa.load');
route::get('payment_verify', 'User\PaymentVerificationController@eSewaVerifyForProduct')->name('esewa.verify');

//order verify wallet
route::post('wallet/verify', 'User\PaymentVerificationController@walletVerifyForProduct')->name('wallet.verfiy');

//esewa for wallet
route::get('wallet_verify_esewa', 'User\PaymentVerificationController@walletVerifyEsewa')->name('wallet.esewa.verify');

//paypal verify //idk if needed
route::post('paypal/verify', 'User\PaymentVerificationController@walletVerifyPayPal')->name('paypal.verify');

//service detail page
route::get('service-category/{slug}', 'PageController@serviceCategoryDetail')->name('service_category.detail');
route::get('service-detail/{id}', 'PageController@serviceDetail')->name('service.detail');
route::post('service-detail/onclick', 'PageController@serviceDetailOnClick')->name('service.detail.click');
// Route::post('service/autocomplete/search', 'ProductsController@autocompleteSearch')
//     ->name('products.autocomplete.search');

//paypal integration
Route::get('payment/paypal', 'User\CheckoutController@payment')->name('payment.paypal');
Route::get('payment/paypal/cancel', 'User\CheckoutController@cancel')->name('payment.cancel');
Route::get('payment/paypal/success', 'User\CheckoutController@success')->name('payment.success');
//policy page
Route::get('pages/policy/{slug}', 'PageController@getPolicyPage')->name('page.policy');
// Route::get('pages/about-us', 'PageController@getAboutUs')->name('page.about-us');
