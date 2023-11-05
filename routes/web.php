<?php


use App\Http\Controllers\PosController;
use Illuminate\Auth\Events\Login;
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


Route::group(['middleware' => 'web'], function () {
    Route::view('register', 'register')->name('register');
    Route::get('/', [PosController::class, 'index'])->name('/');
    Route::view('login', 'login');
    Route::post('login', [PosController::class, 'login'])->name('login');
    Route::post('logout', [PosController::class, 'logout'])->name('logout');
    Route::post('register', [PosController::class, 'register'])->name('register_candidat');
});
