<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Route::middleware('auth', 'verified')->namespace('App\Livewire')->group(function(){
    Route::get('dashboard', Dashboard\Index::class)
        ->middleware('roles:admin,superadmin,leader,personnel')
        ->name('dashboard');

    Route::prefix('user')->name('user.')->middleware('roles:superadmin,admin')->group(function(){
        Route::get('/', User\Index::class)->name('index');
        Route::get('/tambah', User\Create::class)->name('create');
        Route::get('/{id}/sunting', User\Edit::class)->name('edit');
    });

    Route::prefix('institution')->name('institution.')->middleware('roles:superadmin,admin')->group(function(){
        Route::get('/', Institution\Index::class)->name('index');
    });

    Route::prefix('personnel')->name('personnel.')->middleware('roles:superadmin,admin')->group(function(){
        Route::get('/', Personnel\Index::class)->name('index');
        Route::get('/tambah', Personnel\Create::class)->name('create');
        Route::get('/{id}/sunting', Personnel\Edit::class)->name('edit');
    });

    Route::prefix('profil')->name('profile.')->group(function () {
        Route::get('/', Profile\Index::class)
            ->middleware('roles:admin,superadmin,leader,personel')
            ->name('index');
    });
});
