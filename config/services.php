<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
     */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', '608244150537968'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', 'cc94a4a7c3417e9a7bc588c8885b529b'),
        'redirect' => env('FB_REDIRECT', 'https://demo.murarkey.com/login/facebook/callback'),
    ],
    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect' => env('TWITTER_URL'),
    ],
    'google' => [
        'client_id' => '1024913058659-nv7of56jn2cirmghbav10ua6jc64sv1d.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://murarkey.com/login/google/callback',
    ],

];
