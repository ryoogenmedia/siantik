<?php

use App\Http\Controllers\CetakLaporanController;
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

    Route::prefix('user')->name('user.')->middleware('roles:superadmin')->group(function(){
        Route::get('/', User\Index::class)->name('index');
        Route::get('/tambah', User\Create::class)->name('create');
        Route::get('/{id}/sunting', User\Edit::class)->name('edit');
    });

    Route::prefix('absensi')->name('absence.')->middleware('roles:personnel')->group(function(){
        Route::get('/', Absence\Index::class)->name('index');
    });

    Route::prefix('riwayat')->name('history.')->middleware('roles:personnel')->group(function(){
        Route::get('/', History\Absence::class)->name('absence');
    });

    Route::prefix('cetak')->name('print.')->group(function(){
        Route::get('/laporan-admin', [CetakLaporanController::class,'admin'])->name('admin');
        Route::get('/laporan-pimpinan', [CetakLaporanController::class,'leader'])->name('leader');
    });

    Route::prefix('permission')->name('permission.')->middleware('roles:admin')->group(function(){
        Route::get('/', Permission\Index::class)->name('index');
        Route::get('/tambah', Permission\Create::class)->name('create');
        Route::get('/{id}/sunting', Permission\Edit::class)->name('edit');
    });

    Route::prefix('laporan')->name('report.')->group(function(){
        Route::get('/admin', Report\Admin::class)->middleware('roles:admin')->name('admin');
    });

    Route::prefix('laporan-harian')->name('daily-report.')->group(function(){
        Route::get('/leader', Report\Leader::class)->middleware('roles:leader')->name('leader');
    });

    Route::prefix('lokasi')->name('institution.')->middleware('roles:superadmin')->group(function(){
        Route::get('/', Institution\Index::class)->name('index');
    });

    Route::prefix('personnel')->name('personnel.')->middleware('roles:superadmin')->group(function(){
        Route::get('/', Personnel\Index::class)->name('index');
        Route::get('/tambah', Personnel\Create::class)->name('create');
        Route::get('/{id}/sunting', Personnel\Edit::class)->name('edit');
    });

    Route::prefix('profil')->name('profile.')->group(function () {
        Route::get('/', Profile\Index::class)
            ->middleware('roles:admin,superadmin,leader,personnel')
            ->name('index');
    });
});
