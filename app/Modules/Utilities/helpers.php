<?php

use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Support\Facades\Config;

function get_css_class($errors, $field)
{
    return $errors->has($field) ? ' has_input_error' : '';
}

function get_user_type($user = null)
{
    $user = $user ? $user : auth()->user();

    switch ($user->role) {
        case 'ordinary-user':
            $message = 'Basic';
            break;
        case 'main-seller':
            $message = $user->seller->company->status == 'pending' ? 'Company Application Pending Approval.' : 'Main Seller';
            break;
        case 'associate-seller':
            $message = 'Associate Seller';
            break;
    }

    return $message;
}

function get_slides()
{
    $service = app(\Modules\Admin\Contracts\SliderService::class);

    static $slides;

    if ($slides == null) {
        $slides = $service->getSlides();
    }

    return $slides;
}

function formatDateString($dateString, $format = 'Y-m-d')
{
    return date($format, strtotime($dateString));
}

function get_meta_by_key($key)
{
    return app(\Modules\Admin\Contracts\MetaService::class)->findByKey($key)->value;
}

function get_theme_setting_by_key($key)
{
    // return app(\Modules\Admin\Contracts\ThemeSettingServiceInterface::class)->findByKey($key)->value;
}

function get_business_type()
{
    $value = get_meta_by_key('business_type');
    $business_type = explode(',', $value);

    return $business_type;
}

function get_banner_type()
{
    $value = config('systemSetting.banner_type');
    $banner_type = explode(',', $value);

    return $banner_type;
}
function get_unit_types()
{
    $value = get_meta_by_key('supported_units');
    $unit_types = explode(',', $value);
    return $unit_types;
}

function role_match($roles)
{
    $roles = explode('|', $roles);

    if (auth()->check()) {
        $user = auth()->user();

        if ($user->role == 'main-seller' && $user->seller->company->is_pending) {
            return false;
        }

        return in_array($user->role, $roles);
    }
    return false;
}

function get_banner_by_position($position)
{
    $service = app(\Modules\Admin\Contracts\BannerService::class);
    if ($banner = $service->findByPosition($position)) {
        return $banner;
    }

    return '';
}

function get_banners_by_slug($slug)
{
    $service = app(\Modules\Admin\Contracts\BannerService::class);

    if ($banner = $service->findAllBySlug($slug)) {
        return $banner;
    }

    return '';
}

function get_companies()
{
    $service = app(\Modules\Companies\Contracts\CompanyRepository::class);

    return $service->lists();
}

function get_empty_array($number = 1)
{
    $array = [];
    for ($i = 0; $i < $number; $i++) {
        $array[] = ['type' => '977', 'number' => ''];
    }

    return $array;
}

function get_countries_with_phone_code()
{
    $service = app(\Modules\Location\Contracts\LocationService::class);

    return $service->getCountriesWithPhoneCode() + ['' => 'Country Code'];
}

function get_categories_for_form()
{
    $repo = app(\Modules\Categories\Contracts\CategoryRepository::class);
    $list = $repo->lists();
    $list[''] = 'Root Category';

    return $list;
}

function generateTree($categories)
{
    foreach ($categories as $category) {
        echo '<li id="categoryId_' . $category->id . '">';
        echo '<div><span class="disclose fa fa-minus"></span>' . $category->name . '</div>';
        if ($category->children) {
            echo '<ol>';
            generateTree($category->children);
            echo '</ol>';
        }
        echo '</li>';
    }
}
function generateNestedTree($categories)
{
    foreach ($categories as $category) {

        //    <li class="list-group-item">
        //         <div class="media">
        //             <img src="{{ asset('/backend/app-assets/images/portrait/small/avatar-s-12.jpg')}}" class="rounded-circle mr-2" alt="img-placeholder" height="50" width="50">
        //             <div class="media-body">
        //                 <h5 class="mt-0">Mary S. Navarre</h5>
        //                 Chupa chups tiramisu apple pie biscuit sweet roll bonbon macaroon toffee icing.
        //             </div>
        //         </div>
        //     </li>

        echo '<ol class="list-group-item id="categoryId_' . $category->id . '">';
        echo '<div class="media">';
        echo '<div class="media media-body">';
        echo '<h5 class="mt-0"><span class="disclose fa fa-minus"></span>' . $category->name . '</h5>';
        if ($category->children) {
            generateNestedTree($category->children);
        }
        echo '</div">';
        echo '</div">';
        echo '</ol>';
    }
}

function get_page_templates()
{
    $path = resource_path('views/pages/templates/');
    $files = glob($path . '*');
    foreach ($files as $key => $file) {
        $files[$key] = str_replace($path, '', $file);
        $files[$key] = str_replace('.blade.php', '', $files[$key]);
    }

    return array_combine($files, $files);
}

function get_root_categories()
{
    $repo = app(\Modules\Categories\Contracts\CategoryRepository::class);

    return $repo->getRootCategories();
}

function get_site_logo()
{
    return map_storage_path_to_link(get_meta_by_key('logo'));
}

function get_categories_tree()
{
    $repo = app(\Modules\Categories\Contracts\CategoryRepository::class);
    return $repo->getTree();
}

function get_dividing_number($number)
{
    return (int) ($number % 2 == 0 ? ($number / 2) : ($number / 2) + 1);
}

function get_countries()
{
    $service = app(\Modules\Location\Contracts\LocationService::class);

    return array_prepend($service->getAllCountries()->toArray(), 'Please Select');
}

function get_unit_type()
{
    $value = get_meta_by_key('unit_type');
    $unit_type = explode(',', $value);
    $unit_types = array_combine($unit_type, $unit_type);
    return $unit_types + ['' => 'Select Unit'];
}

function formated_status($status)
{
    // return get_general_status()[$status];
}

function get_general_status()
{
    return [
        'pending' => 'Approval Pending',
        'approved' => 'Approved',
        'editing_required' => 'Editing Required',
    ];
}

function products_search_route($category_slug)
{
    return route('products.search') . '?category=' . $category_slug;
}
function products_search_by_brand($brand_slug)
{
    return route('products.search') . '?brand=' . $brand_slug;
}
function products_search_by_company($company_slug)
{
    return route('products.search') . '?company=' . $company_slug;
}

function like_match($pattern, $subject, $case = true)
{
    if (!$case) {
        $pattern = strtolower($pattern);
        $subject = strtolower($subject);
    }

    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}

function get_product_ids_from_featured_products($products)
{
    $ids = [];
    $products->map(function ($product) use (&$ids) {
        $ids[] = $product->product->id;
    });

    return $ids;
}

function get_homepage_featured_categories()
{
    return app(\Modules\Admin\Contracts\FeaturedCategoryRepository::class)->getForHomePage();
}

function get_homepage_featured_companies()
{
    return app(\Modules\Admin\Contracts\FeaturedCompanyRepository::class)->getForHomePage();
}

function get_recently_added_products_for_homepage($count)
{
    return app(\Modules\Products\Contracts\ProductRepository::class)->getRecentlyAdded($count);
}

function getUnreadMessagesCount()
{
    static $message_count = null;
    $userId = auth()->user()->id;
    if ($message_count === null) {
        $message_count = Chat::getUnReadConversationCount($userId);
    }

    return $message_count;
}

function storage_app_path($path)
{
    return storage_path('app/' . $path);
}

function parsePosition($position)
{
    return abs((int) str_replace('px', '', $position));
}

function get_cropped_image_path($path)
{
    $pieces = explode('/', $path);

    $pieces[count($pieces) - 1] = 'cropped_' . $pieces[count($pieces) - 1];

    return implode('/', $pieces);
}

function get_unread_invitation_count()
{
    $userId = auth()->user()->id;

    return app(\Modules\MessageCenter\Contracts\InvitationMessageRepository::class)->getUnreadCount($userId);
}

function get_invitation_count()
{
    static $invitation_count = null;
    $userId = auth()->user()->id;

    if ($invitation_count === null) {
        $invitation_count = app(\Modules\MessageCenter\Contracts\InvitationMessageRepository::class)->getCount($userId);
    }

    return $invitation_count;
}

function get_product_editing_required_count()
{
    $company_id = auth()->user()->seller->company_id;
    $user_id = auth()->user()->isAssociateSeller() ? auth()->user()->id : null;

    return app(\Modules\Products\Contracts\ProductRepository::class)->getProductCountByStatus('editing_required', $company_id, $user_id);
}

function get_featured_product_count($companyId = null)
{
    $companyId = $companyId ? $companyId : auth()->user()->seller->company_id;

    return app(\Modules\Products\Contracts\ProductRepository::class)->getFeaturedProductCount($companyId);
}

function get_associate_sellers($companyId = null)
{
    return app(\Modules\Users\Services\UserService::class)->getAssociateSellers($companyId);
}

function readNumber($num, $depth = 0)
{
    $num = (int) $num;
    $retval = "";
    if ($num < 0) // if it's any other negative, just flip it and call again
    {
        return "negative "+readNumber(-$num, 0);
    }

    if ($num > 99) // 100 and above
    {
        if ($num > 999) // 1000 and higher
        {
            $retval .= readNumber($num / 1000, $depth + 3);
        }

        $num %= 1000; // now we just need the last three digits
        if ($num > 99) // as long as the first digit is not zero
        {
            $retval .= readNumber($num / 100, 2) . " hundred\n";
        }

        $retval .= readNumber($num % 100, 1); // our last two digits
    } else // from 0 to 99
    {
        $mod = floor($num / 10);
        if ($mod == 0) // ones place
        {
            if ($num == 1) {
                $retval .= "one";
            } else if ($num == 2) {
                $retval .= "two";
            } else if ($num == 3) {
                $retval .= "three";
            } else if ($num == 4) {
                $retval .= "four";
            } else if ($num == 5) {
                $retval .= "five";
            } else if ($num == 6) {
                $retval .= "six";
            } else if ($num == 7) {
                $retval .= "seven";
            } else if ($num == 8) {
                $retval .= "eight";
            } else if ($num == 9) {
                $retval .= "nine";
            }

        } else if ($mod == 1) // if there's a one in the ten's place
        {
            if ($num == 10) {
                $retval .= "ten";
            } else if ($num == 11) {
                $retval .= "eleven";
            } else if ($num == 12) {
                $retval .= "twelve";
            } else if ($num == 13) {
                $retval .= "thirteen";
            } else if ($num == 14) {
                $retval .= "fourteen";
            } else if ($num == 15) {
                $retval .= "fifteen";
            } else if ($num == 16) {
                $retval .= "sixteen";
            } else if ($num == 17) {
                $retval .= "seventeen";
            } else if ($num == 18) {
                $retval .= "eighteen";
            } else if ($num == 19) {
                $retval .= "nineteen";
            }

        } else // if there's a different number in the ten's place
        {
            if ($mod == 2) {
                $retval .= "twenty ";
            } else if ($mod == 3) {
                $retval .= "thirty ";
            } else if ($mod == 4) {
                $retval .= "forty ";
            } else if ($mod == 5) {
                $retval .= "fifty ";
            } else if ($mod == 6) {
                $retval .= "sixty ";
            } else if ($mod == 7) {
                $retval .= "seventy ";
            } else if ($mod == 8) {
                $retval .= "eighty ";
            } else if ($mod == 9) {
                $retval .= "ninety ";
            }

            if (($num % 10) != 0) {
                $retval = rtrim($retval); //get rid of space at end
                $retval .= "-";
            }
            $retval .= readNumber($num % 10, 0);
        }
    }

    if ($num != 0) {
        if ($depth == 3) {
            $retval .= " thousand\n";
        } else if ($depth == 6) {
            $retval .= " million\n";
        }

        if ($depth == 9) {
            $retval .= " billion\n";
        }

    }
    return $retval;
}

function null_user()
{
    return new App\Models\User(['first_name' => 'Deleted User', 'last_name' => '', 'profile_pic' => null]);
}

function get_formated_sort_by($key)
{
    $sort_by = [
        '' => 'Best Match',
        'lowest_price' => 'Lowest Price',
        'highest_price' => 'Highest Price',
        'recently_added' => 'Recently Added',
    ];

    return isset($sort_by[$key]) ? $sort_by[$key] : '';
}

function get_unread_system_message_count()
{
    static $message_count = null;
    $repo = app(\Modules\MessageCenter\Contracts\SystemMessageRepository::class);

    if ($message_count === null) {
        $message_count = $repo->getUnreadMessageCount(auth()->user());
    }

    return $message_count;
}

function total_count_of_notification()
{
    return get_unread_system_message_count() + get_invitation_count() + getUnreadMessagesCount();
}

function getCompanyImageModificationDetails($company)
{
    return $company->images->pluck('modification_details', 'id');
}

function get_area_codes()
{
    return \App\Models\LocationAreaCode::pluck('area_code');
}

function hide_permit_upload()
{
    return (bool) get_meta_by_key('hide-permit');
}

function get_categories_for_showcase($count)
{
    $categories = collect();

    foreach (get_categories_tree() as $mainCategory) {
        foreach ($mainCategory->children as $category) {
            $categories->push($category);
        }

    }

    return $categories->shuffle()->take($count);
}

function get_categories_for_showcase_women($count)
{
    $categories = collect();

    foreach (get_categories_tree() as $mainCategory) {
        if ($mainCategory->slug == 'women') {
            foreach ($mainCategory->children as $category) {
                $categories->push($category);
            }
        }

    }

    return $categories->shuffle()->take($count);
}

function get_random_for_homepage($count)
{
    return app(\Modules\Products\Contracts\ProductRepository::class)->getRecentlyAdded($count)->shuffle();
}

function get_random_below_1500_products($count)
{
    return app(\Modules\Products\Contracts\ProductRepository::class)->findProductsBelow1500($count);
}

function get_cities()
{
    return \App\Models\LocationCity::orderBy('name')->get();
}

function get_can_review($productId)
{
    return app(\Modules\Products\Contracts\ReviewService::class)->canReview(auth()->user(), $productId);
}

function get_latest_reviews($productId)
{
    return app(\Modules\Products\Contracts\ReviewService::class)->getLatestReviewsForProduct($productId);
}

function get_reviews_info($productId)
{
    return app(\Modules\Products\Contracts\ReviewService::class)->getReviewsInfo($productId);
}

function get_cities_for_normal_select()
{

    $normalCities = [];
    foreach (get_cities() as $city) {
        $normalCities[$city->name] = $city->name;
    }

    return $normalCities;
}

function get_flash_sales_for_homepage()
{
    $flashSale = \App\Models\FlashSale::where('start_time', '<=', \Carbon\Carbon::now())->where('end_time', '>=', \Carbon\Carbon::now())->where('published', 1)->orderBy('weight', 'DESC')->get();

    if ($flashSale) {
        $flashSale->load('items.product.flash_sale_item', 'items.product.images');
    }
    // dd($flashSale);
    return $flashSale;
}

function get_similar_products_for_product_page($product)
{
    $search_fields = ['name', 'slug'];
    $search_terms = explode(' ', $product->name);

    $query = Product::query();
    foreach ($search_terms as $term) {
        $query->orWhere(function ($query) use ($search_fields, $term) {
            foreach ($search_fields as $field) {
                $query->orWhere($field, 'like', '%' . $term . '%');
            }
        });
    }
    ;
    return $query->take(4)->get();
}

function get_coming_soon_auction_sales($count)
{
    return Product::onlyApproved()->where('auction', true)
        ->whereNull('auction_end_date')
        ->orderBy('created_at', 'DESC')
        ->with(Product::$relationship)
        ->take($count)
        ->get();
}

function get_running_auction_sales($count)
{
    return Product::onlyApproved()->where('auction', true)
        ->whereNotNull('auction_end_date')
        ->where('auction_end_date', '>', Carbon\Carbon::now())
        ->orderBy('created_at', 'DESC')
        ->with(Product::$relationship)
        ->take($count)
        ->get();
}

function sendSms($mobileNumber, $text)
{
    $client = new GuzzleHttp\Client();

    $client->post('https://aakashsms.com/admin/public/sms/v1/send', [
        'form_params' => [
            'auth_token' => config('sms.auth_token'),
            'from' => config('sms.from'),
            'to' => $mobileNumber,
            'text' => $text,
        ],
    ]);

    return true;
}

function sendOtpForRegistration($user)
{
    sendSms($user->phone_number, 'From : ' . get_meta_by_key('site_name') . ' Verification Code is ' . $user->sms_verify_token);
}
