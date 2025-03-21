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

Route::middleware('auth', 'verified')->namespace('App\Livewire')->group(function () {
    Route::get('dashboard', Dashboard\Index::class)
        ->middleware('roles:admin,superadmin,leader,personil')
        ->name('dashboard');

    Route::prefix('user')->name('user.')->middleware('roles:superadmin')->group(function () {
        Route::get('/', User\Index::class)->name('index');
        Route::get('/tambah', User\Create::class)->name('create');
        Route::get('/{id}/sunting', User\Edit::class)->name('edit');
    });

    Route::prefix('presensi')->name('absence.')->middleware('roles:personil')->group(function () {
        Route::get('/', Absence\Index::class)->name('index');
    });

    Route::prefix('riwayat')->name('history.')->middleware('roles:personil')->group(function () {
        Route::get('/kehadiran', History\Absence::class)->name('absence');
        Route::get('/perizinan', History\Permission::class)->name('permission');
    });


    Route::prefix('cetak')->name('print.')->group(function () {
        Route::get('/laporan-admin', [CetakLaporanController::class, 'admin'])->name('admin');
    });

    Route::prefix('permission')->name('permission.')->middleware('roles:admin')->group(function () {
        Route::get('/', Permission\Index::class)->name('index');
        Route::get('/tambah', Permission\Create::class)->name('create');
        Route::get('/{id}/sunting', Permission\Edit::class)->name('edit');
    });

    Route::prefix('laporan')->name('report.')->group(function () {
        Route::get('/admin', Report\Admin::class)->middleware('roles:admin')->name('admin');
        Route::get('/admin/detail/{id}', Report\AdminDetail::class)->middleware('roles:admin')->name('admin-detail');
    });

    Route::prefix('laporan-harian')->name('daily-report.')->group(function () {
        Route::get('/leader', Report\Leader::class)->middleware('roles:leader')->name('leader');
        Route::get('/leader/detail/{id}', Report\LeaderDetail::class)->middleware('roles:leader')->name('leader-detail');
    });

    Route::prefix('lokasi')->name('institution.')->middleware('roles:superadmin')->group(function () {
        Route::get('/', Institution\Index::class)->name('index');
    });

    Route::prefix('personil')->name('personnel.')->middleware('roles:superadmin')->group(function () {
        Route::get('/', Personnel\Index::class)->name('index');
        Route::get('/tambah', Personnel\Create::class)->name('create');
        Route::get('/{id}/sunting', Personnel\Edit::class)->name('edit');
    });

    Route::prefix('profil')->name('profile.')->group(function () {
        Route::get('/', Profile\Index::class)
            ->middleware('roles:admin,superadmin,leader,personil')
            ->name('index');
    });
});
