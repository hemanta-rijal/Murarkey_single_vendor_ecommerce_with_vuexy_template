<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    |
    | {route}/{template}/{filename}
    |
    | Examples: "images", "img/cache"
    |
     */

    'route' => 'image/cache',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submited
    | by URI.
    |
    | Define as many directories as you like.
    |
     */

    'paths' => array(
        storage_path('app/public/products'),
        storage_path('app/public/companies'),
        storage_path('app/public/categories'),
        storage_path('app/public/parlours'),
        storage_path('app/public/services'),
        storage_path('app/public/logo'),
        storage_path('app/public/sliders'),
        storage_path('app/public/brands'),
        storage_path('app/public/testimonials'),
        storage_path('app/public/profile-pics'),
        public_path('assets/img'),
    ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
     */

    'templates' => array(
        'small' => 'Intervention\Image\Templates\Small',
        'medium' => 'Intervention\Image\Templates\Medium',
        'large' => 'Intervention\Image\Templates\Large',
        '50X50' => \Modules\ImageTemplates\Image50X50::class,
        '100X35' => \Modules\ImageTemplates\Image100X35::class,
        '600X600' => \Modules\ImageTemplates\Image600X600::class,
        '100X100' => \Modules\ImageTemplates\Image100X100::class,
        '200X200' => \Modules\ImageTemplates\Image200X200::class,
    ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
     */

    'lifetime' => 4323423,

);
