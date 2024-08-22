<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuperadminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');
// ->middleware('guest')

Route::post('/login-auth', [LoginController::class, 'loginAuth'])->name('login.auth');

Route::middleware('IsLogin')->group(function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    // Route::get('/logout', [LoginController::class , 'logout'])->name('logout');

    Route::middleware("IsAdmin")->group(function () {
        Route::prefix('users')->name('admin.user.')->group(function() {
            Route::get('/', [SuperadminController::class, 'index'])->name('index');
        });

        Route::prefix('data-master')->name('admin.data-master.')->group(function() {
            Route::get('/rayon', [SuperadminController::class, 'indexRayon'])->name('index-rayon');
            Route::post('/store-rayon', [SuperadminController::class, 'storeRayon'])->name('store-rayon');
            Route::get('/edit-rayon/{id}', [SuperadminController::class, 'getDataRayon']);
            Route::patch('/update-rayon/{id}', [SuperadminController::class, 'updateDataRayon']);
            Route::delete('/delete-rayon/{id}', [SuperadminController::class, 'deleteDataRayon']);

            Route::get('/rombel', [SuperadminController::class, 'indexRombel'])->name('index-rombel');
            Route::post('/store-rombel', [SuperadminController::class, 'storeDataRombel'])->name('store-rombel');
            Route::get('/edit-rombel/{id}', [SuperadminController::class, 'getDataRombel']);
            Route::patch('/update-rombel/{id}', [SuperadminController::class, 'updateDataRombel']);


        });
    });

    Route::middleware(['IsGuru'])->group(function () {});
});
