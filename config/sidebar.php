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
        'title' => 'Profile',
        'icon' => 'profile',
        'route-name' => 'profile.index',
        'description' => 'Untuk melihat profil akun.',
        'roles' => ['admin', 'superadmin','personnel','leader'],
    ],
];
