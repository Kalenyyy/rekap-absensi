<?php

use App\Http\Controllers\AbsensiController;
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
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('index');
    Route::get('/data-absen', [DashboardController::class, 'dataAbsen'])->name('data-absen');
    Route::get('/belum-absen', [DashboardController::class, 'getDataSiswaBelumAbsen'])->name('belum-absen');
    Route::get('/search', [DashboardController::class, 'search'])->name('search');
    Route::get('/search-absen-today', [DashboardController::class, 'searchAbsenToday'])->name('search.absen.today');


    Route::middleware("IsAdmin")->group(function () {
        Route::prefix('users')->name('admin.user.')->group(function () {
            Route::get('/', [SuperadminController::class, 'indexUser'])->name('index');
            Route::post('/store-guru', [SuperadminController::class, 'storeDataGuru'])->name('store-guru');
            Route::get('/edit-guru/{id}', [SuperadminController::class, 'getDataGuru']);
            Route::post('/update-guru/{id}', [SuperadminController::class, 'updateGuru']);
        });

        Route::prefix('register-siswa')->name('admin.register.')->group(function () {
            Route::get('/', [AbsensiController::class, 'indexRegister'])->name('index');
            Route::get('/search', [AbsensiController::class, 'search'])->name('search');
            Route::get('/siswa/{id}', [AbsensiController::class, 'RegisterSiswa'])->name('RegisterSiswa');
            Route::post('/import-siswa', [AbsensiController::class, 'importSiswa'])->name('import');
            Route::post('/register-siswa', [AbsensiController::class, 'registerFace'])->name('register-face');
        });

        Route::prefix('absen-siswa')->name('admin.absen.')->group(function () {
            Route::get('/', [AbsensiController::class, 'indexAbsen'])->name('index');
            Route::post('/recognize-face', [AbsensiController::class, 'recognizeFace'])->name('recognizeFace');
            Route::post('/absen-siswa', [AbsensiController::class, 'absenSiswa'])->name('absenSiswa');
        });

        Route::prefix('data-master')->name('admin.data-master.')->group(function () {
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

        Route::prefix('rekap')->name('admin.rekap.')->group(function () {
            Route::get('/', [RekapController::class, 'index'])->name('index');
        });
    });
});
