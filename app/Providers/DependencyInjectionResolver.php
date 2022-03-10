<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Brand\Contracts\BrandRepo;
use Modules\Brand\Contracts\BrandServiceRepo;
use Modules\Brand\Repositories\DbBrandRepository;
use Modules\Brand\Services\BrandService;

class DependencyInjectionResolver extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(
            \Modules\Users\Contracts\UserRepository::class,
            \Modules\Users\Repositories\DbUserRepository::class
        );

        $this->app->bind(
            \Modules\Users\Contracts\UserService::class,
            \Modules\Users\Services\UserService::class
        );

        $this->app->bind(
            \Modules\Admin\Contracts\MetaRepository::class,
            \Modules\Admin\Repositories\DbMetaRepository::class
        );

        $this->app->bind(
            \Modules\Admin\Contracts\MetaService::class,
            \Modules\Admin\Services\MetaService::class
        );

        $this->app->bind(
            \Modules\Admin\Contracts\ThemeSettingRepositoryInterface::class,
            \Modules\Admin\Repositories\DBThemeSettingRepository::class
        );

        $this->app->bind(
            \Modules\Admin\Contracts\ThemeSettingServiceInterface::class,
            \Modules\Admin\Services\ThemeSettingService::class
        );

        $this->app->bind(
            \Modules\Admin\Contracts\SliderRepository::class,
            \Modules\Admin\Repositories\DbSliderRepository::class
        );

        $this->app->bind(
            \Modules\Admin\Contracts\SliderService::class,
            \Modules\Admin\Services\SliderService::class
        );

        $this->app->bind(
            \Modules\Admin\Contracts\BannerRepository::class,
            \Modules\Admin\Repositories\DbBannerRepository::class
        );

        $this->app->bind(
            \Modules\Admin\Contracts\BannerService::class,
            \Modules\Admin\Services\BannerService::class
        );

//        $this->app->bind(
//            \Modules\Admin\Contracts\FeaturedCategoryRepository::class,
//            \Modules\Admin\Repositories\DbFeaturedCategoryRepository::class
//        );
//
//        $this->app->bind(
//            \Modules\Admin\Contracts\FeaturedCompanyRepository::class,
//            \Modules\Admin\Repositories\DbFeaturedCompanyRepository::class
//        );

        $this->app->bind(
            \Modules\Location\Contracts\LocationService::class,
            \Modules\Location\Services\LocationService::class
        );

        $this->app->bind(
            \Modules\Location\Contracts\LocationRepository::class,
            \Modules\Location\Repositories\DbLocationRepository::class
        );

        $this->app->bind(
            \Modules\Companies\Contracts\CompanyRepository::class,
            \Modules\Companies\Repositories\DbCompanyRepository::class
        );

        $this->app->bind(
            \Modules\Companies\Contracts\CompanyService::class,
            \Modules\Companies\Services\CompanyService::class
        );

        $this->app->bind(
            \Modules\Categories\Contracts\CategoryRepository::class,
            \Modules\Categories\Repositories\DbCategoryRepository::class
        );

        $this->app->bind(
            \Modules\Categories\Contracts\CategoryService::class,
            \Modules\Categories\Services\CategoryService::class
        );

        $this->app->bind(
            \Modules\Admin\Contracts\PageService::class,
            \Modules\Admin\Services\PageService::class
        );

        $this->app->bind(
            \Modules\Admin\Contracts\PageRepository::class,
            \Modules\Admin\Repositories\DbPageRepository::class
        );

        $this->app->bind(
            \Modules\Products\Contracts\ProductService::class,
            \Modules\Products\Services\ProductService::class
        );

        $this->app->bind(
            \Modules\Products\Contracts\ProductRepository::class,
            \Modules\Products\Repositories\DbProductRepository::class
        );

        $this->app->bind(
            \Modules\Newsletter\Contracts\NewsletterService::class,
            \Modules\Newsletter\Services\NewsletterService::class
        );

        $this->app->bind(
            \Modules\Newsletter\Contracts\NewsletterRepository::class,
            \Modules\Newsletter\Repositories\DbNewsletterRepository::class
        );

        $this->app->bind(
            \Modules\MessageCenter\Contracts\MessageRepository::class,
            \Modules\MessageCenter\Repositories\DbMessageRepository::class
        );

        $this->app->bind(
            \Modules\MessageCenter\Contracts\MessageService::class,
            \Modules\MessageCenter\Services\MessageService::class
        );

        $this->app->bind(
            \Modules\MessageCenter\Contracts\SystemMessageService::class,
            \Modules\MessageCenter\Services\SystemMessageService::class
        );

        $this->app->bind(
            \Modules\MessageCenter\Contracts\SystemMessageRepository::class,
            \Modules\MessageCenter\Repositories\DbSystemMessageRepository::class
        );

        $this->app->bind(
            \Modules\MessageCenter\Contracts\InvitationMessageRepository::class,
            \Modules\MessageCenter\Repositories\DbInvitationMessageRepository::class
        );

        $this->app->bind(
            \Modules\MessageCenter\Contracts\InvitationMessageService::class,
            \Modules\MessageCenter\Services\InvitationMessageService::class
        );

        $this->app->bind(
            \Modules\Products\Contracts\ReviewService::class,
            \Modules\Products\Services\ReviewService::class
        );

        $this->app->bind(
            \Modules\Products\Contracts\ProductReviewRepository::class,
            \Modules\Products\Repositories\DbProductReviewRepository::class
        );

        $this->app->bind(
            \Modules\Cart\Contracts\CartService::class,
            \Modules\Cart\Services\CartService::class
        );

        $this->app->bind(
            \Modules\Cart\Contracts\WishlistService::class,
            \Modules\Cart\Services\WishlistService::class
        );

        $this->app->bind(
            \Modules\Orders\Contracts\OrderService::class,
            \Modules\Orders\Services\OrderService::class
        );

        $this->app->bind(
            \Modules\Orders\Contracts\OrderRepository::class,
            \Modules\Orders\Repositiories\DbOrderRepository::class
        );

        // Flash Sales

        $this->app->bind(
            \Modules\FlashSales\Contracts\FlashSalesRepository::class,
            \Modules\FlashSales\Repositories\DbFlashSalesRepository::class
        );

        //  brands

        $this->app->bind(
            BrandRepo::class,
            DbBrandRepository::class
        );
        $this->app->bind(
            BrandServiceRepo::class,
            BrandService::class
        );

        // attributes
        $this->app->bind(
            \Modules\Attribute\Contracts\AttributeRepository::class,
            \Modules\Attribute\Repositories\DbAttributeRepository::class
        );
        $this->app->bind(
            \Modules\Attribute\Contracts\AttributeServiceRepository::class,
            \Modules\Attribute\Services\AttributeService::class
        );

        //parlour Listing
        $this->app->bind(
            \Modules\ParlourListings\Contracts\ParlourListingRepository::class,
            \Modules\ParlourListings\Repositories\DbParlourListingRepository::class
        );
        $this->app->bind(
            \Modules\ParlourListings\Contracts\ParlourListing::class,
            \Modules\ParlourListings\Services\ParlourListingService::class
        );

        //Coupon management
        $this->app->bind(
            \Modules\Coupon\Contracts\CouponRepository::class,
            \Modules\Coupon\Repositories\DbCouponRepository::class
        );
        $this->app->bind(
            \Modules\Coupon\Contracts\CouponService::class,
            \Modules\Coupon\Services\CouponService::class
        );

        //Join Murarkey
        $this->app->bind(
            \Modules\JoinMurarkey\Contracts\JoinMurarkeyRepository::class,
            \Modules\JoinMurarkey\Repositories\DbJoinMurarkeyRepository::class
        );
        $this->app->bind(
            \Modules\JoinMurarkey\Contracts\JoinMurarkeyService::class,
            \Modules\JoinMurarkey\Services\JoinMurarkeyService::class
        );

        //payment verification
        $this->app->bind(
            \Modules\PaymentVerification\Contracts\PaymentVerificationRepository::class,
            \Modules\PaymentVerification\Repositiories\DbPaymentVerificationRepository::class
        );
        $this->app->bind(
            \Modules\PaymentVerification\Contracts\PaymentVerificationServices::class,
            \Modules\PaymentVerification\Services\PaymentVerificationServices::class
        );

        // wallet
        $this->app->bind(
            \Modules\Wallet\Contracts\WalletRepository::class,
            \Modules\Wallet\Repositories\DbWalletRepository::class
        );
        $this->app->bind(
            \Modules\Wallet\Contracts\WalletService::class,
            \Modules\Wallet\Services\WalletService::class
        );

        //testimonial
        $this->app->bind(
            \Modules\Testimonial\Contracts\TestimonialRepository::class,
            \Modules\Testimonial\Repositories\DbTestimonialRepository::class
        );
        $this->app->bind(
            \Modules\Testimonial\Contracts\TestimonialService::class,
            \Modules\Testimonial\Services\TestimonialService::class
        );

        //service categories
        $this->app->bind(
            \Modules\ServiceCategories\Contracts\ServiceCategoryRepository::class,
            \Modules\ServiceCategories\Repositories\DbServiceCategoryRepository::class
        );
        $this->app->bind(
            \Modules\ServiceCategories\Contracts\ServiceCategoryService::class,
            \Modules\ServiceCategories\Services\ServiceCategoryService::class
        );

        //service categories
        $this->app->bind(
            \Modules\Service\Contracts\ServiceRepository::class,
            \Modules\Service\Repositories\DbServiceRepository::class
        );
        $this->app->bind(
            \Modules\Service\Contracts\ServiceService::class,
            \Modules\Service\Services\ServiceService::class
        );

        // attributes
        $this->app->bind(
            \Modules\ServiceLabel\Contracts\ServiceLabelRepository::class,
            \Modules\ServiceLabel\Repositories\DbServiceLabelRepository::class
        );
        $this->app->bind(
            \Modules\ServiceLabel\Contracts\ServiceLabelServiceRepository::class,
            \Modules\ServiceLabel\Services\ServiceLabelService::class
        );

        // faqs
        $this->app->bind(
            \Modules\Faq\Contracts\FaqRepository::class,
            \Modules\Faq\Repositories\DbFaqRepository::class
        );
        $this->app->bind(
            \Modules\Faq\Contracts\FaqServiceRepository::class,
            \Modules\Faq\Services\FaqServices::class
        );

        // roles
        $this->app->bind(
            \Modules\Role\Contracts\RoleRepository::class,
            \Modules\Role\Repositories\DbRoleRepository::class
        );
        $this->app->bind(
            \Modules\Role\Contracts\RoleServiceRepository::class,
            \Modules\Role\Services\RoleService::class
        );

        //admin users
        $this->app->bind(
            \Modules\AdminUser\Contracts\AdminUserRepository::class,
            \Modules\AdminUser\Repositories\DbAdminUserRepository::class
        );

        $this->app->bind(
            \Modules\AdminUser\Contracts\AdminUserService::class,
            \Modules\AdminUser\Services\AdminUserService::class
        );

        //currency
        $this->app->bind(
            \Modules\Currency\Contracts\CurrencyRepository::class,
            \Modules\Currency\Repositories\DbCurrencyRepository::class
        );

        $this->app->bind(
            \Modules\Currency\Contracts\CurrencyServiceRepository::class,
            \Modules\Currency\Services\CurrencyService::class
        );

    }

}
