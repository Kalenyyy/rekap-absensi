<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersentasiController;
use App\Http\Controllers\RekapController;

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



Route::get('/Camera', [CameraController::class, 'index'])->name('camera.index');
Route::get('/camera/ruangan/{id}', [CameraController::class, 'ruangan'])->name('camera.ruangan');


Route::get('/', function () {
    return view('login');
})->name('login');
// ->middleware('guest')

Route::post('/login-auth', [LoginController::class, 'loginAuth'])->name('login.auth');

Route::middleware('IsLogin')->group(function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    // Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::prefix('dashboard')->name('dashboard.')->group(function() {
        Route::get('/', [LoginController::class, 'dashboard'])->name('index');
        // Route::get('/index', [DashboardController::class, 'index'])->name('index');
      
    });    
    // Route::get('/logout', [LoginController::class , 'logout'])->name('logout');

    Route::middleware("IsAdmin")->group(function () {
        Route::prefix('users')->name('admin.user.')->group(function() {
            Route::get('/', [SuperadminController::class, 'index'])->name('index');
        });

        Route::prefix('persntasi')->name('admin.persntasi.')->group(function() {
            Route::get('/', [PersentasiController::class, 'index'])->name('index');
        });

        Route::prefix('rekap')->name('admin.rekap.')->group(function() {
            Route::get('/', [RekapController::class, 'index'])->name('index');
            Route::get('/bulanan', [RekapController::class, 'bulanan'])->name('bulanan');
        });

        Route::prefix('data-master')->name('admin.data-master.')->group(function() {
            Route::get('/', [SuperadminController::class, 'indexDataMaster'])->name('index');
        });
    });

    Route::middleware(['IsGuru'])->group(function () {});
});
