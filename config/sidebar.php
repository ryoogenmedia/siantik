<?php

return [
    [
        'title' => 'Dashboard',
        'icon' => 'home',
        'route-name' => 'dashboard',
        'description' => 'Untuk melihat ringkasan aplikasi.',
        'roles' => ['admin', 'superadmin', 'personil', 'leader'],
    ],

    [
        'title' => 'Lokasi',
        'icon' => 'map-marker',
        'route-name' => 'institution.index',
        'description' => 'Untuk melihat daftar institusi.',
        'roles' => ['superadmin'],
    ],

    [
        'title' => 'Laporan Harian',
        'icon' => 'user-check',
        'route-name' => 'daily-report.leader',
        'description' => 'Untuk melihat daftar laporan presensi harian personil.',
        'roles' => ['leader'],
    ],

    [
        'title' => 'Presensi',
        'icon' => 'home',
        'route-name' => 'absence.index',
        'description' => 'Untuk melakukan presensi.',
        'roles' => ['personil'],
    ],

    [
        'title' => 'Riwayat Kehadiran',
        'icon' => 'id-card',
        'route-name' => 'history.absence',
        'description' => 'Untuk melihat riawyat kehadiran.',
        'roles' => ['personil'],
    ],

    [
        'title' => 'Laporan Harian Dan Bulanan',
        'icon' => 'file-alt',
        'route-name' => 'report.admin',
        'description' => 'Untuk melihat daftar laporan admin.',
        'roles' => ['admin'],
    ],

    [
        'title' => 'Perizinan',
        'icon' => 'user-check',
        'route-name' => 'permission.index',
        'description' => 'Untuk melihat daftar izin personil & pimpinan.',
        'roles' => ['admin'],
    ],

    [
        'title' => 'Daftar Personil',
        'icon' => 'id-card',
        'route-name' => 'personnel.index',
        'description' => 'Untuk melihat daftar personil.',
        'roles' => ['superadmin'],
    ],

    [
        'title' => 'Daftar Pengguna',
        'icon' => 'user',
        'route-name' => 'user.index',
        'description' => 'Untuk melihat daftar pengguna.',
        'roles' => ['superadmin'],
    ],

    [
        'title' => 'Profil',
        'icon' => 'user-circle',
        'route-name' => 'profile.index',
        'description' => 'Untuk melihat profil akun.',
        'roles' => ['admin', 'superadmin', 'personil', 'leader'],
    ],
];
