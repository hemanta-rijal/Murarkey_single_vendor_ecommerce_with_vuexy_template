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
    'first_ad_status' => 'please change it',
    'first_ad_link' => 'please change it',
    'first_ad_image' => 'please change it',
    'second_ad_status' => 'please change it',
    'second_ad_link' => 'please change it',
    'second_ad_image' => 'please change it',
    'third_ad_status' => 'please change it',
    'third_ad_link' => 'please change it',
    'third_ad_image' => 'please change it',
    'fourth_ad_status' => 'please change it',
    'fourth_ad_link' => 'please change it',
    'fourth_ad_image' => 'please change it',
    'fifth_ad_status' => 'please change it',
    'fifth_ad_link' => 'please change it',
    'fifth_ad_image' => 'please change it',
    'flash_sales_status' => 'please change it',
    'max_number_of_flash_sale_item' => 'please change it',
    'products_below_1500_status' => 'please change it',
    'max_number_of_item_on_products_below_1500' => 'please change it',
    'featured_products_status' => 'please change it',
    'you_may_like_products_status' => 'please change it',
    'max_number_of_you_may_like_items' => 'please change it',
    'new_arrivals_status' => 'please change it',
    'max_number_of_items_on_new_arrivals' => 'please change it',
    'first_featuring_showcase' => 'please change it',
    'second_featuring_showcase' => 'please change it',
    'third_featuring_showcase' => 'please change it',
    'forth_featuring_showcase' => 'please change it',
    'primary_menu' => '2',
    'site_links_menu' => '4',
    'quick_links_menu' => '3',
  ),
  'systemSetting' => 
  array (
    'site_name' => NULL,
    'primary_contact_number' => NULL,
    'full_address' => NULL,
    'site_description' => NULL,
    '' => NULL,
    'site_keywords' => NULL,
    'facebook_link' => NULL,
    'twitter_link' => NULL,
    'instagram_link' => NULL,
    'google-plus_link' => NULL,
    'youtube_link' => NULL,
    'linkedin_link' => NULL,
    'tracking' => NULL,
    'contact_email' => NULL,
    'all_right_reserved' => NULL,
    'supported_countries' => NULL,
    'default_country' => NULL,
    'supported_locales' => NULL,
    'default_locale' => NULL,
    'default_timezone' => NULL,
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
    'esewa_status' => 'on',
    'esewa_scd' => 'jfdfdsalfmds',
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
    'free_shipping_status' => 'on',
    'free_shipping_label' => 'Shipping Charge',
    'free_shipping_minimum_amount' => '100',
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
    'supported_units' => NULL,
    'default_unit' => NULL,
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
    'custom_tax_on_product' => '13',
    'custom_tax_on_service' => '13',
    'privacy_policy' => NULL,
    '\'return_policy' => NULL,
    'support_policy' => NULL,
    'terms_and_condition' => NULL,
  ),
);
