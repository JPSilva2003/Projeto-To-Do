<?php

return [
    'install-button' => true,

    'manifest' => [
        'name' => 'To-Do App',
        'short_name' => 'ToDo',
        'background_color' => '#ffffff',
        'theme_color' => '#3f51b5',
        'display' => 'standalone',
        'start_url' => '/',
        'description' => 'A Laravel-based Progressive Web App',
        'icons' => [
            [
                'src' => '/logo.png',
                'sizes' => '512x512',
                'type' => 'image/png',
            ],
        ],
    ],

    'debug' => env('APP_DEBUG', false),
];

