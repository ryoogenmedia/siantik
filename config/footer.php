<?php

return [
    [
        'title' => 'Dashboard',
        'icon' => 'home',
        'icon-active' => 'home-active',
        'route-name' => 'dashboard',
        'is-active' => 'dashboard',
        'description' => 'Untuk melihat ringkasan aplikasi.',
        'roles' => ['admin', 'superadmin','personnel','leader'],
    ],

    [
        'title' => 'Data Pengguna',
        'icon' => 'home',
        'icon-active' => 'home-active',
        'route-name' => 'user.index',
        'is-active' => 'user.index',
        'description' => 'Untuk melihat daftar pengguna.',
        'roles' => ['admin', 'superadmin'],
    ],

    [
        'title' => 'Profil',
        'icon' => 'profile',
        'icon-active' => 'profile-act',
        'route-name' => 'profile.index',
        'is-active' => 'profile.index',
        'description' => 'Untuk melihat profil akun.',
        'roles' => ['admin', 'superadmin','personnel','leader'],
    ],
];
