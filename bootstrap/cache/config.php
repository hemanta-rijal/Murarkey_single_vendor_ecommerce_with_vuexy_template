<?php return array (
  'app' => 
  array (
    'name' => 'Site Name From Config',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'timezone' => 'Asia/Katmandu',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => 'base64:OXa/liy8PkRz6163RafPDj8EZIt2muRXZQGL8mm47SI=',
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
    'files' => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\routes/breadcrumbs.php',
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
        'path' => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\framework/cache/data',
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
        'database' => 'webcommerce1',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'webcommerce1',
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
        'database' => 'webcommerce1',
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
      'path' => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\debugbar',
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
      'font_dir' => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\fonts/',
      'font_cache' => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\fonts/',
      'isRemoteEnabled' => true,
      'temp_dir' => 'C:\\Users\\WEBROOT\\AppData\\Local\\Temp',
      'chroot' => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template',
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
      'local_path' => 'C:\\Users\\WEBROOT\\AppData\\Local\\Temp',
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
        'root' => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public',
        'url' => 'http://localhost/storage',
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
      0 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/products',
      1 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/companies',
      2 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/categories',
      3 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/parlours',
      4 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/services',
      5 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/service-categories',
      6 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/logo',
      7 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/sliders',
      8 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/brands',
      9 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/testimonials',
      10 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\app/public/profile-pics',
      11 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\public\\assets/img',
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
    'secret' => 'Yh9TuqkmpH8A1GXdii7Sv1tew4u9Lp8hr3ozsggaaHKgpLH1q1Kxx6H7EMVte8O7',
    'keys' => 
    array (
      'public' => NULL,
      'private' => NULL,
      'passphrase' => NULL,
    ),
    'ttl' => 1488,
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
    'host' => 'mailtrap.io',
    'port' => '2525',
    'from' => 
    array (
      'address' => '',
      'name' => '',
    ),
    'encryption' => NULL,
    'username' => 'pumili.dev',
    'password' => 'admin@pumili',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\resources\\views/vendor/mail',
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
      'client_id' => '2184173585180556',
      'client_secret' => '43322f5ec9b677002c0273b95749ea7e',
      'redirect' => 'http://104.199.234.164/auth/facebook/callback',
    ),
    'twitter' => 
    array (
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => NULL,
    ),
    'google' => 
    array (
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\framework/sessions',
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
      0 => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\resources\\views',
    ),
    'compiled' => 'D:\\project\\murarkey\\Murarkey_single_vendor_ecommerce_with_vuexy_template\\storage\\framework\\views',
  ),
  'themeSetting' => 
  array (
    'first_ad_status' => 'on',
    'flash_sale_status' => 'off',
    'max_number_of_flash_sale_item' => '732',
    'products_below_1500_status' => 'on',
    'featured_category_status' => 'on',
    'first_featuring_showcase' => 'women_collection',
    'second_featuring_showcase' => 'men_collection',
    'third_featuring_showcase' => 'groceries_collection',
    'forth_featuring_showcase' => 'house_collection',
    'max_number_of_you_may_like_items' => '268',
    'new_arrivals_status' => 'off',
    'max_number_of_items_on_new_arrivals' => '482',
    'max_number_of_item_on_products_below_1500' => '176',
    'second_ad_status' => 'off',
    'you_may_like_products_status' => 'on',
    'third_ad_status' => 'on',
    'fourth_ad_status' => 'off',
    'fifth_ad_status' => 'off',
    'first_ad_image' => 'public/ads/hwwHn3WfoxyJG61bEbUXkE6gLl1OBCYShR4xlIgD.jpg',
    'second_ad_image' => 'public/ads/YFN0LMJxyUPAabt6LTLMP060Z8IMAiGTh6YCII7d.png',
    'third_ad_image' => 'public/ads/1Y2iNtw57jqIwazufsc6ZXpAh99tyVUvKLmrPuHe.png',
    'fourth_ad_image' => 'public/ads/H1za0z083v3MwtSMXJtL0SGcH48CQlGiDeWKONPT.png',
    'fifth_ad_image' => 'public/ads/fFJXdof5v8E0y97YXr7iPRo9vsUI6Q5XSkhPwkie.png',
    'first_ad_link' => 'Tempore atque sit a',
    'second_ad_link' => 'Dolorem beatae aliqu',
    'third_ad_link' => 'Est dolor id sint do',
    'fourth_ad_link' => 'Ex consequuntur et m',
    'fifth_ad_link' => 'Hic impedit magna p',
  ),
  'systemSetting' => 
  array (
    'banner_type' => 'homepage-1,homepage-2,product-details,user-dashboard,login-page,homepage-slider,service-schedule',
    'business_type' => 'Trading Company,Distributor / Wholesaler,Other',
    'hide-permit' => '1',
    'site_name' => 'Yeeco Mart',
    'site_description' => 'Shop online your favorite cosmetic &amp; beauty products. Book premium parlor/salon services at home. Skip the line. Bring the best barbers &amp; stylists right to you.',
    'facebook_link' => 'facebook.com',
    'twitter_link' => 'twitter.com',
    'instagram_link' => 'InstaGram.com',
    'google-plus_link' => 'googleplus.com',
    'youtube_link' => 'youtubelink.com',
    'linkedin_link' => 'linkedin.com',
    'site_keywords' => 'Murarkey,Book Beauty service at home',
    'tracking' => '',
    'frontend_primary_logo' => 'public/frontend_primary_logo/B4nJBxGE6jn2KWiRDXZTQPnR7dtawK7ys8wsGPb8.png',
    'contact_email' => 'kabmart@gmail.com',
    'all_right_reserved' => 'please change it',
    'unit_type' => 'kilogram,kilohertz,Meter,Ampere,Case',
    'supported_countries' => 'supported_countries',
    'default_country' => 'default_country',
    'supported_locales' => 'supported_locales',
    'default_locale' => 'default_locale',
    'default_timezone' => 'default_timezone',
    'maintenance_mode' => 'off',
    'allowed_IPs' => 'https://webcart.envaysoft.com/#maintenance
https://webcart.envaysoft.com/#maintenance',
    'supported_currencies' => 'supported_currencies',
    'default_currency' => 'default_currency',
    'mail_from_address' => 'mail_from_address update',
    'mail_from_name' => 'mail_from_name',
    'mail_host' => 'mail_host',
    'mail_port' => 'mail_port',
    'mail_username' => 'mail_username',
    'mail_password' => 'mail_password',
    'mail_encryption' => 'tls',
    'newsletter_mode' => 'true',
    'mailchimp_api_key' => 'mailchimp_api_key',
    'mailchimp_list_id' => 'mailchimp_list_id',
    'custom_header' => 'custom_header',
    'custom_footer' => 'custom_footer',
    'paypal_status' => 'on',
    'paypal_description' => 'Voluptas nemo volupt',
    'paypal_sandbox' => 'on',
    'paypal_client_id' => 'Voluptas velit sit',
    'paypal_secreate_key' => 'Pa$$w0rd!',
    'stripe_status' => 'off',
    'stripe_label' => 'Tempor ullamco excep',
    'stripe_description' => 'Reprehenderit possim',
    'stripe_publishable_key' => 'Culpa magna eos no',
    'stripe_secreate_key' => 'Pa$$w0rd!',
    'cash_on_delivery_status' => 'on',
    'cash_on_delivery_label' => 'cash_on_delivery_labelsdf',
    'cash_on_delivery_description' => 'cash_on_delivery_descriptionsadfdsf',
    'bank_transfer_status' => 'on',
    'cash_on_delivery_instruction' => 'saf                    cash_on_delivery_instruction',
    'free_shipping_status' => 'off',
    'free_shipping_label' => 'Free Shippingsdsa',
    'free_shipping_minimum_amount' => '15',
    'local_pick_up_status' => 'off',
    'local_pickup_label' => 'local_pickup_label',
    'local_pickup_cost' => '100',
    'flat_rate_status' => 'off',
    'flat_rate_label' => 'flat_rate_label',
    'flat_rate_cost' => '15',
    'bank_transfer_label' => 'bank_transfer_label_this',
    'bank_transfer_description' => 'sbank_transfer_description',
    'paypal_label' => 'Officia dolorum repu',
    'gmail' => 'example@gmail.com',
    'supported_units' => 'KG,Meter,Liter',
    'default_unit' => 'KG',
    'facebook_login_status' => 'please change it',
    'facebook_callback' => 'please change it',
    'facebook_client_secrete' => 'please change it',
    'facebook_client_id' => 'please change it',
    'google_login_status' => 'please change it',
    'google_callback' => 'please change it',
    'google_client_secrete' => 'please change it',
    'google_client_id' => 'please change it',
    'twitter_login_status' => 'please change it',
    'twitter_callback' => 'please change it',
    'twitter_client_secrete' => 'please change it',
    'twitter_client_id' => 'please change it',
    'site_map_link' => 'https://google.com',
    'seo_author' => 'Murarkey2',
    'seo-revisit' => '5',
    'seo_description' => 'Shop online your favorite cosmetic &amp; beauty products. Book premium parlor/salon services at home. Skip the line. Bring the best barbers &amp; stylists right to you.',
    'facebook_app_id' => 'please change it',
    'admin_dashboard_logo' => 'public/admin_dashboard_logo/wZvAna9R02tx0JzsSYwcn5I8IDqx1EE2PbTRMHml.png',
    'frontend_footer_logo' => 'public/frontend_footer_logo/fCBOpRrg8bAW21LWAeSz62TvnrBeshfKXdJ5cnOC.png',
    'frontend_secondary_logo' => 'C:\\xampp\\tmp\\phpF3DC.tmp',
    'frontend_header_logo' => 'public/frontend_header_logo/m85LngbnjR1SUXce5iPJmM2gTASohnKpJ28hGlvx.png',
    'favicon_icon' => 'public/favicon_icon/tgY03l08otQy8u8oobm5VUdbJatTre2kWm0gGRBk.png',
    'primary_contact_number' => NULL,
    'full_address' => NULL,
    '' => NULL,
    'mail_driver' => NULL,
    'frontend_header_background_logo' => NULL,
    'esewa_status' => 'on',
    'esewa_scd' => 'EPAYTEST',
  ),
);
