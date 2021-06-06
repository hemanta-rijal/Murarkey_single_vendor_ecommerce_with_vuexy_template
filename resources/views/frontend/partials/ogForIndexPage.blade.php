<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ config('systemSetting.site_name', 'Laravel') }}">
<meta itemprop="description" content="{{ config('systemSetting.seo_description') }}">
<meta itemprop="image" content="{{ getFrontendPrimaryLogo() }}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="{{ config('systemSetting.site_name', 'Laravel') }}">
<meta name="twitter:description" content="{{ config('systemSetting.seo_description') }}">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="{{ getFrontendPrimaryLogo() }}">

<!-- Open Graph data -->
<meta property="og:title" content="{{ config('systemSetting.site_name', 'Laravel') }}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ route('home') }}" />
<meta property="og:image" content="{{ getFrontendPrimaryLogo() }}" />
<meta property="og:description" content="{{ config('systemSetting.seo_description') }}" />
<meta property="og:site_name" content="{{ config('systemSetting.site_name', 'Laravel') }}" />
<meta property="fb:app_id" content="{{ config('systemSetting.facebook_app_id', env('FACEBOOK_PIXEL_ID')) }}">