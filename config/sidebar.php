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
        'title' => 'Lokasi',
        'icon' => 'home',
        'route-name' => 'institution.index',
        'description' => 'Untuk melihat daftar institusi.',
        'roles' => ['superadmin'],
    ],

    [
        'title' => 'Laporan Harian',
        'icon' => 'home',
        'route-name' => 'daily-report.leader',
        'description' => 'Untuk melihat daftar laporan presensi harian personnel.',
        'roles' => ['leader'],
    ],

    [
        'title' => 'Absensi',
        'icon' => 'home',
        'route-name' => 'absence.index',
        'description' => 'Untuk melakukan absensi.',
        'roles' => ['personnel'],
    ],

    [
        'title' => 'Riwayat Kehadiran',
        'icon' => 'home',
        'route-name' => 'history.absence',
        'description' => 'Untuk melihat riawyat kehadiran.',
        'roles' => ['personnel'],
    ],

    [
        'title' => 'Laporan Bulanan',
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
        'title' => 'Tambah Personil',
        'icon' => 'home',
        'route-name' => 'personnel.index',
        'description' => 'Untuk melihat daftar personnel.',
        'roles' => ['superadmin'],
    ],

    [
        'title' => 'Tambah Pengguna',
        'icon' => 'home',
        'route-name' => 'user.index',
        'description' => 'Untuk melihat daftar pengguna.',
        'roles' => ['superadmin'],
    ],

    [
        'title' => 'Profil',
        'icon' => 'profile',
        'route-name' => 'profile.index',
        'description' => 'Untuk melihat profil akun.',
        'roles' => ['admin', 'superadmin','personnel','leader'],
    ],
];
