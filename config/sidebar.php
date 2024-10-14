<?php

return [
    [
        'title' => 'Dashboard',
        'icon' => 'home',
        'route-name' => 'dashboard',
        'description' => 'Untuk melihat ringkasan aplikasi.',
        'roles' => ['admin', 'superadmin','personnel','leader'],
    ],

    [
        'title' => 'Personnel',
        'icon' => 'home',
        'route-name' => 'personnel.index',
        'description' => 'Untuk melihat daftar personnel.',
        'roles' => ['admin', 'superadmin'],
    ],

    [
        'title' => 'Pengguna',
        'icon' => 'home',
        'route-name' => 'user.index',
        'description' => 'Untuk melihat daftar pengguna.',
        'roles' => ['admin', 'superadmin'],
    ],

    [
        'title' => 'Profile',
        'icon' => 'profile',
        'route-name' => 'profile.index',
        'description' => 'Untuk melihat profil akun.',
        'roles' => ['admin', 'superadmin','personnel','leader'],
    ],
];
