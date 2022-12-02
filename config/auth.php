<?php
return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'donor' => [
            'driver' => 'session',
            'provider' => 'donors',
        ],
        'hospital' => [
            'driver' => 'session',
            'provider' => 'hospitals',
        ],
    ], 

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'donors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Donor::class,
        ],
        'hospitals' => [
            'driver' => 'eloquent',
            'model' => App\Models\Hospital::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'donors' => [
            'provider' => 'donors',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'hospitals' => [
            'provider' => 'hospitals',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];