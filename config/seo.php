<?php

return [
    'title' => config('app.name'),
    'description' => config('app.description'),
    'canonical' => config('app.url'),
    'author' => 'Leonardo Poletto',
    'url' => config('app.url'),

    /*
    |--------------------------------------------------------------------------
    | Website Schema
    |--------------------------------------------------------------------------
    |
    | Schema Validator : https://validator.schema.org/
    |
    */
    'schema' => [
        '@context' => 'http://schema.org',
        '@type' => 'WebSite',
        'name' => config('app.name'),
        'url' => config('app.url'),
        'description' => config('app.description'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Open Graph
    |--------------------------------------------------------------------------
    |
    | General Validation : https://www.opengraph.xyz/
    | Facebook Validation: https://developers.facebook.com/tools/debug/
    |
    */
    'opengraph' => [
        'title' => config('app.name'),
        'type' => 'website',
        'url' => config('app.url'),
        'image' => fn() => asset('og.webp'),
        'image:alt' => fn() => asset('og.webp'),
        'description' => config('app.description'),
        'locale' => 'en-US',
    ],

    /*
    |--------------------------------------------------------------------------
    | Twitter Open Graph
    |--------------------------------------------------------------------------
    |
    | Validation: https://cards-dev.twitter.com/validator
    |
    */
    'twitter' => [
        'card' => 'summary_large_image',
        'site' => config('app.url'),
        'creator' => '@leopoletto',
        'title' => config('app.name'),
        'description' => config('app.description'),
        'image' => fn() => asset('og.webp'),
        'image:alt' => fn() => asset('og.webp'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Icons
    |--------------------------------------------------------------------------
    |
    | Suggestion:
    | Favicon Generator: https://realfavicongenerator.net/
    |
    */
    'icons' => [
        'apple-touch-icon' => [
            'href' => fn() => asset('apple-touch-icon.png'),
            'rel' => 'apple-touch-icon',
            'sizes' => '180x180',
        ],
        'icon-96x96' => [
            'href' => fn() => asset('favicon-96x96.png'),
            'rel' => 'icon',
            'type' => 'image/png',
            'sizes' => '96x96',
        ],
        'svg' => [
            'href' => fn() => asset('favicon.svg'),
            'rel' => 'icon',
            'type' => 'image/svg+xml',
        ],
        'x-icon' => [
            'href' => fn() => asset('favicon.ico'),
            'rel' => 'image/x-icon',
        ],
        'manifest' => [
            'href' => fn() => asset('site.webmanifest'),
            'rel' => 'manifest',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Meta tags
    |--------------------------------------------------------------------------
    |
    | Additional Meta tags for colors
    |
    */
    'meta' => [
        'msapplication-TileColor' => '#00cc66',
        'theme-color' => '#00cc66',
    ]
];
