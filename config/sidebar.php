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
        'title' => 'Absensi',
        'icon' => 'home',
        'route-name' => 'absence.index',
        'description' => 'Untuk melakukan absensi.',
        'roles' => ['personnel','leader'],
    ],

    [
        'title' => 'Laporan',
        'icon' => 'home',
        'route-name' => 'report.admin',
        'description' => 'Untuk melihat daftar laporan admin.',
        'roles' => ['admin'],
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
