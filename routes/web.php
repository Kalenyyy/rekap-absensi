<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('/', function (){
    return view('login');
})->name('login');
// ->middleware('guest')

Route::post('/login-auth', [LoginController::class , 'loginAuth'])->name('login.auth');

Route::middleware('IsLogin')->group(function (){
    

Route::get('/index', [LoginController::class , 'index'])->name('welcome');

Route::get('/logout', [LoginController::class , 'logout'])->name('logout');

    Route::middleware("AdminMiddleware")->group(function(){

    
    });
   
    Route::middleware(['GuruMiddleware'])->group(function () {
    
    });   
    

});
