<?php return array (
  'app' => 
  array (
    'name' => 'Site Name From Config',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://127.0.0.1:8000',
    'timezone' => 'Asia/Katmandu',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => 'base64:IAbOO+yFcip7SQnZnw8Uoj1Wue3b6AKSlIMyKxVyX5k=',
    'cipher' => 'AES-256-CBC',
    'log' => 'daily',
    'log_level' => 'debug',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Laravel\\Tinker\\TinkerServiceProvider',
      23 => 'Laravel\\Socialite\\SocialiteServiceProvider',
      24 => 'Collective\\Html\\HtmlServiceProvider',
      25 => 'Laracasts\\Flash\\FlashServiceProvider',
      26 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      27 => 'Intervention\\Image\\ImageServiceProvider',
      28 => 'Musonza\\Chat\\ChatServiceProvider',
      29 => 'Tymon\\JWTAuth\\Providers\\LaravelServiceProvider',
      30 => 'Gloudemans\\Shoppingcart\\ShoppingcartServiceProvider',
      31 => 'App\\Providers\\AppServiceProvider',
      32 => 'App\\Providers\\AuthServiceProvider',
      33 => 'App\\Providers\\BroadcastServiceProvider',
      34 => 'App\\Providers\\EventServiceProvider',
      35 => 'App\\Providers\\RouteServiceProvider',
      36 => 'App\\Providers\\DependencyInjectionResolver',
      37 => 'App\\Providers\\ComposerServiceProvider',
      38 => 'App\\Providers\\ThemeSettingServiceProvider',
      39 => 'App\\Providers\\MetaServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Chat' => 'Musonza\\Chat\\Facades\\ChatFacade',
      'Cart' => 'Gloudemans\\Shoppingcart\\Facades\\Cart',
      'JWTAuth' => 'Tymon\\JWTAuth\\Facades\\JWTAuth',
      'JWTFactory' => 'Tymon\\JWTAuth\\Facades\\JWTFactory',
      'Str' => 'Illuminate\\Support\\Str',
    ),
  ),
  'auth' => 
  array (
    'roles' => 
    array (
      0 => 'ordinary-user',
      1 => 'associate-seller',
      2 => 'main-seller',
    ),
    'defaults' => 
    array (
      'guard' => 'api',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'jwt',
        'provider' => 'users',
      ),
      'admin' => 
      array (
        'driver' => 'session',
        'provider' => 'admin',
      ),
      'operator' => 
      array (
        'driver' => 'session',
        'provider' => 'operator',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
      'admin' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\AdminUser',
      ),
      'operator' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\Operator',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
      'admin' => 
      array (
        'provider' => 'admin',
        'table' => 'admin_password_resets',
        'expire' => 60,
      ),
      'operator' => 
      array (
        'provider' => 'operator',
        'table' => 'operator_password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'breadcrumbs' => 
  array (
    'view' => 'breadcrumbs::bootstrap4',
    'files' => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\routes/breadcrumbs.php',
    'unnamed-route-exception' => true,
    'missing-route-bound-breadcrumb-exception' => true,
    'invalid-named-breadcrumb-exception' => true,
    'manager-class' => 'DaveJamesMiller\\Breadcrumbs\\BreadcrumbsManager',
    'generator-class' => 'DaveJamesMiller\\Breadcrumbs\\BreadcrumbsGenerator',
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'laravel',
  ),
  'cart' => 
  array (
    'tax' => 13,
    'service_tax' => 13,
    'database' => 
    array (
      'connection' => 'mysql',
      'table' => 'shopping_cart',
    ),
    'destroy_on_logout' => false,
    'format' => 
    array (
      'decimals' => 0,
      'decimal_point' => '.',
      'thousand_seperator' => ',',
    ),
  ),
  'chat' => 
  array (
    'user_model' => 'App\\Models\\User',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'db_murarkey_single_vendor_ecom',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'db_murarkey_single_vendor_ecom',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'db_murarkey_single_vendor_ecom',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => '%s %s NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
        2 => 'product.image',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'datatables-buttons' => 
  array (
    'namespace' => 
    array (
      'base' => 'DataTables',
      'model' => '',
    ),
    'pdf_generator' => 'excel',
    'snappy' => 
    array (
      'options' => 
      array (
        'no-outline' => true,
        'margin-left' => '0',
        'margin-right' => '0',
        'margin-top' => '10mm',
        'margin-bottom' => '10mm',
      ),
      'orientation' => 'landscape',
    ),
  ),
  'datatables-html' => 
  array (
    'table' => 
    array (
      'class' => 'table',
      'id' => 'dataTableBuilder',
    ),
    'callback' => 
    array (
      0 => '$',
      1 => '$.',
      2 => 'function',
    ),
    'script' => 'datatables::script',
    'editor' => 'datatables::editor',
  ),
  'debugbar' => 
  array (
    'enabled' => NULL,
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\debugbar',
      'connection' => NULL,
      'provider' => '',
    ),
    'include_vendors' => true,
    'capture_ajax' => true,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'laravel' => false,
      'events' => false,
      'default_request' => false,
      'symfony_request' => true,
      'mail' => true,
      'logs' => false,
      'files' => false,
      'config' => false,
      'auth' => false,
      'gate' => false,
      'session' => true,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => false,
      ),
      'db' => 
      array (
        'with_params' => true,
        'timeline' => false,
        'backtrace' => false,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => true,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\fonts/',
      'font_cache' => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\fonts/',
      'isRemoteEnabled' => true,
      'temp_dir' => 'C:\\Users\\MRPREM~1\\AppData\\Local\\Temp',
      'chroot' => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => 'C:\\Users\\MRPREM~1\\AppData\\Local\\Temp',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public',
        'url' => 'http://127.0.0.1:8000/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
      ),
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
    ),
    'send_logs_as_events' => true,
    'censor_request_body_fields' => 
    array (
      0 => 'password',
    ),
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'imagecache' => 
  array (
    'route' => 'image/cache',
    'paths' => 
    array (
      0 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/products',
      1 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/companies',
      2 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/categories',
      3 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/parlours',
      4 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/services',
      5 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/service-categories',
      6 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/logo',
      7 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/sliders',
      8 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/brands',
      9 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/testimonials',
      10 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/profile-pics',
      11 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\public\\assets/img',
    ),
    'templates' => 
    array (
      'small' => 'Intervention\\Image\\Templates\\Small',
      'medium' => 'Intervention\\Image\\Templates\\Medium',
      'large' => 'Intervention\\Image\\Templates\\Large',
      '50X50' => 'Modules\\ImageTemplates\\Image50X50',
      '100X35' => 'Modules\\ImageTemplates\\Image100X35',
      '600X600' => 'Modules\\ImageTemplates\\Image600X600',
      '100X100' => 'Modules\\ImageTemplates\\Image100X100',
      '200X200' => 'Modules\\ImageTemplates\\Image200X200',
    ),
    'lifetime' => 4323423,
  ),
  'jwt' => 
  array (
    'secret' => 'U2wfe4M40v9WSyKLUnY3jC15URPD0FyYZEGkJ3kBF3At0u8LHRsuljpfxoTou92t',
    'keys' => 
    array (
      'public' => NULL,
      'private' => NULL,
      'passphrase' => NULL,
    ),
    'ttl' => '1488',
    'refresh_ttl' => 20160,
    'algo' => 'HS256',
    'required_claims' => 
    array (
    ),
    'persistent_claims' => 
    array (
    ),
    'lock_subject' => true,
    'leeway' => 0,
    'blacklist_enabled' => true,
    'blacklist_grace_period' => 0,
    'decrypt_cookies' => false,
    'providers' => 
    array (
      'jwt' => 'Tymon\\JWTAuth\\Providers\\JWT\\Lcobucci',
      'storage' => 'Tymon\\JWTAuth\\Providers\\Storage\\Illuminate',
    ),
    'max_refresh_period' => NULL,
  ),
  'laraberg' => 
  array (
    'use_package_routes' => true,
    'middlewares' => 
    array (
      0 => 'web',
      1 => 'auth',
    ),
    'prefix' => 'laraberg',
    'models' => 
    array (
      'block' => 'VanOns\\Laraberg\\Models\\Block',
      'content' => 'VanOns\\Laraberg\\Models\\Content',
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.mailtrap.io',
    'port' => '2525',
    'from' => 
    array (
      'address' => 'Murarkey@gmail.com',
      'name' => 'Murarkey',
    ),
    'encryption' => 'tls',
    'username' => '02d047671122b0',
    'password' => 'b5233883188e34',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\resources\\views/vendor/mail',
      ),
    ),
    'sendmail' => '/usr/sbin/sendmail -bs',
  ),
  'menu' => 
  array (
    'middleware' => 
    array (
    ),
    'table_prefix' => 'admin_',
    'table_name_menus' => 'menus',
    'table_name_items' => 'menu_items',
    'route_path' => '/harimayco/',
    'use_roles' => false,
    'roles_table' => 'roles',
    'roles_pk' => 'id',
    'roles_title_field' => 'name',
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'recaptcha' => 
  array (
    'public_key' => '6Ldk7xUUAAAAAO-iH_lDZP2VpI1abWhMQvTkP-FX',
    'private_key' => '6Ldk7xUUAAAAAIxCqYIRzc0fWrYz13TgGsGnMBOY',
    'template' => '',
    'driver' => 'curl',
    'options' => 
    array (
      'curl_timeout' => 1,
    ),
    'version' => 2,
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
    'facebook' => 
    array (
      'client_id' => '762924154400913',
      'client_secret' => 'c22a37dc0294ee439289b04b18acc9dd',
      'redirect' => 'http://127.0.0.1:8000/login/facebook/callback',
    ),
    'twitter' => 
    array (
      'client_id' => '',
      'client_secret' => '',
      'redirect' => 'http://127.0.0.1:8000/login/twitter/callback',
    ),
    'google' => 
    array (
      'client_id' => '1065829685281-nne7smfbeu1e8g2ar9ikunafm4k03gv3.apps.googleusercontent.com',
      'client_secret' => 'q9BFJvX18NEPuTPhw5va3Axw',
      'redirect' => 'http://127.0.0.1:8000/login/google/callback',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
  ),
  'sluggable' => 
  array (
    'source' => NULL,
    'maxLength' => NULL,
    'method' => NULL,
    'separator' => '-',
    'unique' => true,
    'uniqueSuffix' => NULL,
    'includeTrashed' => true,
    'reserved' => NULL,
    'onUpdate' => false,
  ),
  'sms' => 
  array (
    'auth_token' => '65033408754791f9a0c7c225f332a1775a4742180ec333766ba7f3b1c66631d6',
    'from' => '31001',
  ),
  'snappy' => 
  array (
    'pdf' => 
    array (
      'enabled' => true,
      'binary' => '/usr/local/bin/wkhtmltopdf',
      'timeout' => false,
      'options' => 
      array (
      ),
      'env' => 
      array (
      ),
    ),
    'image' => 
    array (
      'enabled' => true,
      'binary' => '/usr/local/bin/wkhtmltoimage',
      'timeout' => false,
      'options' => 
      array (
      ),
      'env' => 
      array (
      ),
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 94,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\resources\\views',
    ),
    'compiled' => 'D:\\Web Dev\\Laravel\\_Developing_Phase_Project\\Murarkey Single Vendor\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\framework\\views',
  ),
  'themeSetting' => 
  array (
  ),
  'systemSetting' => 
  array (
    'unit_type' => 'kilogram,kilohertz,Meter,Ampere,Case',
    'site_name' => 'Blossom Moody',
    'primary_contact_number' => '495',
    'full_address' => 'Qui vel nobis volupt',
    'site_description' => 'Ea ipsa harum et so',
    '' => NULL,
    'site_keywords' => NULL,
    'facebook_link' => NULL,
    'twitter_link' => NULL,
    'instagram_link' => NULL,
    'google-plus_link' => NULL,
    'youtube_link' => NULL,
    'linkedin_link' => NULL,
    'tracking' => NULL,
    'contact_email' => 'lyxutina@mailinator.com',
    'all_right_reserved' => NULL,
    'supported_countries' => 'Irure ea nihil quia',
    'default_country' => 'Saepe voluptate veri',
    'supported_locales' => 'Rerum possimus sit',
    'default_locale' => 'Quam adipisci non ir',
    'default_timezone' => 'Blanditiis aut excep',
    'maintenance_mode' => 'on',
    'allowed_IPs' => NULL,
    'supported_currencies' => NULL,
    'default_currency' => NULL,
    'mail_driver' => NULL,
    'mail_from_address' => NULL,
    'mail_from_name' => NULL,
    'mail_host' => NULL,
    'mail_port' => NULL,
    'mail_username' => NULL,
    'mail_password' => NULL,
    'mail_encryption' => NULL,
    'newsletter_mode' => NULL,
    'mailchimp_api_key' => NULL,
    'mailchimp_list_id' => NULL,
    'custom_header' => NULL,
    'custom_footer' => NULL,
    'esewa_status' => NULL,
    'esewa_scd' => NULL,
    'paypal_sandbox' => NULL,
    'paypal_client_id' => NULL,
    'paypal_secreate_key' => NULL,
    'stripe_status' => NULL,
    'stripe_label' => NULL,
    'stripe_description' => NULL,
    'stripe_publishable_key' => NULL,
    'stripe_secreate_key' => NULL,
    'cash_on_delivery_status' => NULL,
    'cash_on_delivery_label' => NULL,
    'cash_on_delivery_description' => NULL,
    'bank_transfer_status' => NULL,
    'cash_on_delivery_instruction' => NULL,
    'free_shipping_status' => NULL,
    'free_shipping_label' => NULL,
    'free_shipping_minimum_amount' => NULL,
    'local_pick_up_status' => NULL,
    'local_pickup_label' => NULL,
    'local_pickup_cost' => NULL,
    'flat_rate_status' => NULL,
    'flat_rate_label' => NULL,
    'flat_rate_cost' => NULL,
    'bank_transfer_label' => NULL,
    'bank_transfer_description' => NULL,
    'paypal_status' => NULL,
    'paypal_description' => NULL,
    'paypal_label' => NULL,
    'supported_units' => 'Dolorem qui aut quo,Nesciunt odio ad do,Commodi atque nisi i,Ut ut enim eos labor,Dolore odio dolor an,Incidunt quos dolor,Dolor nostrum molest,Earum proident nost,Facilis rem quis mag,Repellendus Est seq,Aut sed consequuntur,Voluptatibus reicien,Omnis sit sint repr,Ex natus sed illum,Aut magna dolores co,Quod est fugiat sae,Deserunt iure nesciu,Rerum impedit culpa,Voluptas quia sed la,Magna proident quia,Voluptates sunt sit,Alias est sunt quam,Voluptate ducimus b',
    'default_unit' => 'Id id aliquip cupid',
    'facebook_login_status' => NULL,
    'facebook_client_secrete' => NULL,
    'facebook_app_id' => NULL,
    'google_login_status' => NULL,
    'google_client_secrete' => NULL,
    'google_client_id' => NULL,
    'twitter_login_status' => NULL,
    'twitter_client_secrete' => NULL,
    'twitter_client_id' => NULL,
    'site_map_link' => NULL,
    'seo_author' => NULL,
    'seo-revisit' => NULL,
    'seo_description' => NULL,
    'admin_dashboard_logo' => NULL,
    'frontend_footer_logo' => NULL,
    'frontend_header_background_logo' => NULL,
    'frontend_header_logo' => NULL,
    'favicon_icon' => NULL,
    'custom_tax_on_product' => NULL,
    'custom_tax_on_service' => NULL,
    'privacy_policy' => '<h3><strong>Privacy Policy</strong></h3><p>This privacy policy sets out how murarkey.com uses and protects any information that you give murarkey.com when you use this website.</p><p>Murarkey.com is committed to ensuring that your privacy is protected. Should we ask you to provide certain information by which you can be identified when using this website, you can be assured that it will only be used in accordance with this privacy statement.</p><p>Murarkey.com may change this policy from time to time by updating this page. You should check this page from time to time to ensure that you are happy with any changes.</p><p><strong>What we collect</strong></p><p>We may collect the following information:</p><p>-Your name and address.<br>– Contact information including email address, phone number/cell number<br>– Name, address and contact details of the person the goods are being delivered to</p><p><strong>What we do with the information we gather</strong></p><p>We require this information for the following reasons:</p><p>– To confirm the validity of the order placed<br>– To accurately identify the delivery address<br>– Internal record keeping<br>– We may use the information to improve our products and services.<br>– We may periodically send promotional emails about new products, special offers or &nbsp;&nbsp;other information which we think you may find interesting using the email address which you have provided.<br>– From time to time, we may also use your information to contact you for market research purposes. We may contact you by email, phone, fax or mail. We may use the information to customize the website according to your interests.</p><p><strong>How we use cookies</strong></p><p>A cookie is a small file which asks permission to be placed on your computer’s hard drive. Once you agree, the file is added and the cookie helps analyze web traffic or lets you know when you visit a particular site. Cookies allow web applications to respond to you as an individual. The web application can tailor its operations to your needs, likes and dislikes by gathering and remembering information aboAut your preferences.</p><p>We use traffic log cookies to identify which pages are being used. This helps us analyze data about web page traffic and improve our website in order to tailor it to customer needs. We only use this information for statistical analysis purposes and then the data is removed from the system.</p><p><strong>Links to other websites</strong></p><p>Our website may contain links to other websites of interest. However, once you have used these links to leave our site, you should note that we do not have any control over that other website. Therefore, we cannot be responsible for the protection and privacy of any information which you provide whilst visiting such sites and such sites are not governed by this privacy statement. You should exercise caution and look at the privacy statement applicable to the website in question.</p><p><strong>Controlling your personal information</strong><br>We do not sell, distribute or lease your personal information to third parties unless we have your permission or are required by law to do so.</p><p>If you believe that any information we are holding on you is incorrect or incomplete, please write to or email us at solutioncrimson@gmail.com as soon as possible. We will promptly correct any information found to be incorrect.</p>',
    '\'return_policy' => NULL,
    'support_policy' => NULL,
    'terms_and_condition' => '<h3><strong>TERMS AND CONDITIONS</strong></h3><p>&nbsp;</p><p>Welcome to Murarkey.com. We are an online service provider. The domain name www.murarkey.com (hereinafter referred to as “Website”) is owned by Crimson Bay Business Solution&nbsp; Pvt. Ltd a company incorporated under the Sub-section (1) of Section 5 of the Companies Act, 2006 with its registered office at ward no 9, Battisputali, Kathmandu. (hereinafter referred to as “Crimson”).</p><p>&nbsp;</p><p>You may be accessing our site from a computer or mobile phone device (through an iOS or Android application, for example) and these Terms of Use govern your use of our Site and your conduct, regardless of the means of access. You may also be using our interactive services (“Interactive Services“), such as our Beauty Suggestions, Beauty Book etc.</p><p>&nbsp;</p><p>The Site is only to be used for your personal non-commercial use and information. Your use of the services and features of the Site shall be governed by these Terms and Conditions (hereinafter “Terms of Use“) along with the Privacy Policy, Shipping Policy and Cancellation, Refund and Return Policy (together “Policies“) as modified and amended from time to time.</p><p>&nbsp;</p><p>By mere accessing or using the Site, you are acknowledging, without limitation or qualification, to be bound by these Terms of Use and the Polices, whether you have read the same or not. Accessing, browsing or otherwise using the site indicates your agreement to all the terms and conditions in this agreement, so please read this agreement carefully before proceeding. If you do not agree to any of the terms enumerated in the Terms of Use or the Policies, please do not use the Site. You are responsible to ensure that your access to this Site and material available on or through it are legal in each jurisdiction, in or through which you access or view the site or such material.</p><p>&nbsp;</p><p>Crimson reserves the right to change the particulars contained in the Terms of Use or the Policies from time to time and at any time, without notice to its users and in its sole discretion. If Crimson decides to change the Terms of Use or Policies, Crimson will post the new version of the Terms of Use or the Policies on the Site and update the date specified above. Any change or modification to the Terms of Use and the Policies will be effective immediately from the date of such upload of the Terms of Use and Policies on the Site. Your continued use of the Site following the modifications to the Terms of Use and Policies constitutes your acceptance of the modified Terms of Use and Policies whether or not you have read them. For this reason, you should frequently review these Terms of Use, our Guidelines and Rules and any other applicable policies, including their dates, to understand the terms and conditions that apply to your use of the Site.</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p><strong>SITE AVAILABILITY</strong></p><p>We will do our utmost to ensure that access to the Site is consistently available and is uninterrupted and error-free. However, due to the nature of the Internet and the nature of the Site, this cannot be guaranteed. Additionally, your access to the Site may also be occasionally suspended or restricted to allow for repairs, maintenance, or the introduction of new facilities or services at any time without prior notice. We will attempt to limit the frequency and duration of any such suspension or restriction.</p><p>&nbsp;</p><p><strong>GRANT OF LICENSE FOR SITE ACCESS</strong></p><p>We require that by accessing the Site, you confirm that you can form legally binding contracts and therefore you confirm that you are at least 18 years of age or are accessing the Site under the supervision of a parent or legal guardian. We grant you a non-transferable, revocable and non-exclusive license to use the Site, in accordance with the Terms and Conditions described herein, for the purposes of shopping for personal items and services as listed to be sold on the Site. Commercial use or use on behalf of any third party is prohibited, except as explicitly permitted by us in advance. If you are registering as a business entity, you represent that you have the authority to bind that entity to this User Agreement and that you and the business entity will comply with all applicable laws relating to online trading. No person or business entity may register as a member of the Site more than once. Any breach of these Terms and Conditions shall result in the immediate revocation of the license granted in this paragraph without notice to you.<br><br>Content provided on this Site is solely for informational purposes. Product representations including price, available stock, features, add-ons and any other details as expressed on this Site are the responsibility of the vendors displaying them and is not guaranteed as completely accurate by us. Submissions or opinions expressed on this Site are those of the individual(s) posting such content and may not reflect our opinions.<br><br>We grant you a limited license to access and make personal use of this Site, but not to download (excluding page caches) or modify the Site or any portion of it in any manner. This license does not include any resale or commercial use of this Site or its contents; any collection and use of any product listings, descriptions, or prices; any derivative use of this Site or its contents; any downloading or copying of account information for the benefit of another seller; or any use of data mining, robots, or similar data gathering and extraction tools.<br><br>This Site or any portion of it (including but not limited to any copyrighted material, trademarks, or other proprietary information) may not be reproduced, duplicated, copied, sold, resold, visited, distributed or otherwise exploited for any commercial purpose without express written consent by us as may be applicable.<br><br>You may not frame or use framing techniques to enclose any trademark, logo, or other proprietary information (including images, text, page layout, or form) without our express written consent. You may not use any meta tags or any other text utilizing our name or trademark without our express written consent, as applicable. Any unauthorized use terminates the permission or license granted by us to you for access to the Site with no prior notice. You may not use our logo or other proprietary graphic or trademark as part of an external link for commercial or other purposes without our express written consent, as may be applicable.<br><br>You agree and undertake not to perform restricted activities listed within this section; undertaking these activities will result in an immediate cancellation of your account, services, reviews, orders or any existing incomplete transaction with us and in severe cases may also result in legal action.<br><br>&nbsp;</p><ul><li>Refusal to comply with the Terms and Conditions described herein or any other guidelines and policies related to the use of the Site as available on the Site at all times.</li><li>Impersonate any person or entity or to falsely state or otherwise misrepresent your affiliation with any person or entity.</li><li>Use the Site for illegal purposes.</li><li>Attempt to gain unauthorized access to or otherwise interfere or disrupt other computer systems or networks connected to the Platform or Services.</li><li>Interfere with another’s utilization and enjoyment of the Site;</li><li>Post, promote or transmit through the Site any prohibited materials as deemed illegal by The People’s Republic of Nepal.</li><li>Use or upload, in any way, any software or material that contains, or which you have reason to suspect that contains, viruses, damaging components, malicious code or harmful components which may impair or corrupt the Site’s data or damage or interfere with the operation of another Customer’s computer or mobile device or the Site and use the Site other than in conformance with the acceptable use policies of any connected computer networks, any applicable Internet standards and any other applicable laws.</li></ul><p>&nbsp;</p><p><strong>CLAIMS</strong></p><p>We list thousands of products for sale offered by numerous sellers on the Site and host multiple comments on listings, it is not possible for us to be aware of the contents of each product listed for sale, or each comment or review that is displayed. Accordingly, we operate on a “claim, review and takedown” basis. If you believe that any content on the Site is illegal, offensive (including but not limited to material that is sexually explicit content or which promotes racism, bigotry, hatred or physical harm), deceptive, misleading, abusive, indecent, harassing, blasphemous, defamatory, libellous, obscene, pornographic, paedophilic or menacing; ethnically objectionable, disparaging; or is otherwise injurious to third parties; or relates to or promotes money laundering or gambling; or is harmful to minors in any way; or impersonates another person; or threatens the unity, integrity, security or sovereignty of Nepal or friendly relations with foreign States; or objectionable or otherwise unlawful in any manner whatsoever; or which consists of or contains software viruses, (” objectionable content “), please notify us immediately by following by writing to us on SOLUTIONCRIMSON@GMAIL.COM. We will make all practical endeavours to investigate and remove valid objectionable content complained about within a reasonable amount of time.<br><br>Please ensure to provide your name, address, contact information and as many relevant details of the claim including name of objectionable content party, instances of objection, proof of objection amongst other. Please note that providing incomplete details will render your claim invalid and unusable for legal purposes.</p><p><strong>TRADEMARKS AND COPYRIGHTS</strong></p><p>Murarkey, Murarkey logo, M for Murarkey logo, Murarkey, and other marks indicated on our Site are trademarks or registered trademarks in the relevant jurisdiction(s). Our graphics, logos, page headers, button icons, scripts and service names are the trademarks or trade dress and may not be used in connection with any product or service that does not belong to us or in any manner that is likely to cause confusion among customers, or in any manner that disparages or discredits us. All other trademarks that appear on this Site are the property of their respective owners, who may or may not be affiliated with, connected to, or sponsored by us.<br><br>All intellectual property rights, whether registered or unregistered, in the Site, information content on the Site and all the website design, including, but not limited to text, graphics, software, photos, video, music, sound, and their selection and arrangement, and all software compilations, underlying source code and software shall remain our property. The entire contents of the Site also are protected by copyright as a collective work under Nepali copyright laws and international conventions. All rights are reserved.</p><p><strong>LAWS AND JURISDICTION GOVERNED</strong></p><p>These terms and conditions are governed by and construed in accordance with the laws of the Federal Democratic Republic of Nepal. You agree, as we do, to submit to the exclusive jurisdiction of the courts in Katmandu.</p>',
  ),
);
