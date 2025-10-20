<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Component Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk komponen-komponen blade yang digunakan di aplikasi.
    | Centralized configuration untuk consistency dan easy maintenance.
    |
    */

    'colors' => [
        'primary' => [
            'bg' => 'bg-indigo-500',
            'text' => 'text-indigo-500',
            'border' => 'border-indigo-500',
            'hover' => 'hover:bg-indigo-600',
        ],
        'success' => [
            'bg' => 'bg-green-500',
            'text' => 'text-green-500',
            'border' => 'border-green-500',
            'hover' => 'hover:bg-green-600',
        ],
        'warning' => [
            'bg' => 'bg-yellow-500',
            'text' => 'text-yellow-500',
            'border' => 'border-yellow-500',
            'hover' => 'hover:bg-yellow-600',
        ],
        'danger' => [
            'bg' => 'bg-red-500',
            'text' => 'text-red-500',
            'border' => 'border-red-500',
            'hover' => 'hover:bg-red-600',
        ],
        'info' => [
            'bg' => 'bg-blue-500',
            'text' => 'text-blue-500',
            'border' => 'border-blue-500',
            'hover' => 'hover:bg-blue-600',
        ],
    ],

    'event_colors' => [
        'bg-purple-500',
        'bg-blue-500',
        'bg-green-500',
        'bg-yellow-500',
        'bg-red-500',
        'bg-pink-500',
        'bg-indigo-500',
        'bg-teal-500',
        'bg-orange-500',
        'bg-cyan-500',
    ],

    'stat_card' => [
        'default_icon' => 'activity',
        'trend_up_icon' => 'trending-up',
        'trend_down_icon' => 'trending-down',
    ],

    'pagination' => [
        'per_page' => 10,
        'max_links' => 5,
    ],

    'calendar' => [
        'cell_height' => '90px',
        'max_events_per_cell' => 3,
        'days' => ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
    ],
];
