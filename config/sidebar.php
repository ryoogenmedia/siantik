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
        'title' => 'Institusi',
        'icon' => 'home',
        'route-name' => 'institution.index',
        'description' => 'Untuk melihat daftar institusi.',
        'roles' => ['superadmin'],
    ],

    [
        'title' => 'Perizinan',
        'icon' => 'home',
        'route-name' => 'permission.index',
        'description' => 'Untuk melihat daftar izin personnel & pimpinan.',
        'roles' => ['admin'],
    ],

    [
        'title' => 'Personnel',
        'icon' => 'home',
        'route-name' => 'personnel.index',
        'description' => 'Untuk melihat daftar personnel.',
        'roles' => ['superadmin'],
    ],

    [
        'title' => 'Pengguna',
        'icon' => 'home',
        'route-name' => 'user.index',
        'description' => 'Untuk melihat daftar pengguna.',
        'roles' => ['superadmin'],
    ],

    [
        'title' => 'Profile',
        'icon' => 'profile',
        'route-name' => 'profile.index',
        'description' => 'Untuk melihat profil akun.',
        'roles' => ['admin', 'superadmin','personnel','leader'],
    ],
];
