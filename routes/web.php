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
    });

    Route::middleware(['IsGuru'])->group(function () {});
});
