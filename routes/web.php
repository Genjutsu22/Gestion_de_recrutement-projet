<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\candidatcontroller;
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

Route::group(['middleware' => 'admin'], function () {
    Route::view('app-admin/login', 'app-admin.login');
    Route::post('app-admin/login', [Admincontroller::class, 'login_admin'])->name('login_admin');
    Route::get('app-admin/home', [Admincontroller::class, 'index'])->name('app-admin/home');
    Route::post('app-admin/logout', [Admincontroller::class, 'logout_admin'])->name('logout_admin');
    Route::get('app-admin/home/download_offre/{offre}', [Admincontroller::class, 'download_offre'])->name('download_offre');
    Route::get('app-admin/home/departements', [Admincontroller::class, 'show_departements'])->name('app-admin/home/departements');
    Route::delete('app-admin/home/delete_candidat/{candidat}', [Admincontroller::class, 'delete_candidat'])->name('delete_candidat');
    Route::delete('app-admin/home/delete_departement/{id}', [Admincontroller::class, 'delete_departement'])->name('delete_departement');
    Route::post('app-admin/home/add_departement', [Admincontroller::class, 'add_departement'])->name('add_departement');
    Route::post('app-admin/home/edit_departement', [Admincontroller::class, 'edit_departement'])->name('edit_departement');
    Route::get('app-admin/home/professions', [Admincontroller::class, 'show_professions'])->name('app-admin/home/professions');
    Route::delete('app-admin/home/delete_profession/{id}', [Admincontroller::class, 'delete_profession'])->name('delete_profession');
    Route::post('app-admin/home/add_profession', [Admincontroller::class, 'add_profession'])->name('add_profession');
    Route::post('app-admin/home/edit_profession', [Admincontroller::class, 'edit_profession'])->name('edit_profession');
    Route::post('app-admin/home/change_passe', [Admincontroller::class, 'change_passe'])->name('change_passe');
    Route::post('app-admin/home/add_offre', [Admincontroller::class, 'add_offre'])->name('add_offre');
    Route::get('app-admin/home/offres', [Admincontroller::class, 'show_offres'])->name('app-admin/home/offres');
    Route::post('app-admin/home/edit_offre', [Admincontroller::class, 'edit_offre'])->name('edit_offre');
    Route::delete('app-admin/home/delete_offre/{id}', [Admincontroller::class, 'delete_offre'])->name('delete_offre');
    Route::post('app-admin/home/offre_inactive/{id}', [Admincontroller::class, 'offre_inactive'])->name('offre_inactive');
    Route::post('app-admin/home/offre_inactive/{id}', [Admincontroller::class, 'offre_inactive'])->name('offre_inactive');
    Route::get('app-admin/home/demandes/{id}', [Admincontroller::class, 'offres_details'])->name('app-admin/home/demandes');
    Route::post('app-admin/home/accepter_offre', [Admincontroller::class, 'accepter_offre'])->name('app-admin/home/accepter_offre');
    Route::post('app-admin/home/refuse_offre/{id}', [Admincontroller::class, 'refuse_offre'])->name('app-admin/home/refuse_offre');
    Route::view('app-admin.change_passe', 'app-admin.change_passe')->name('change_passe_page');  
    
});
Route::group(['middleware' => 'candidat'], function () {
    Route::get('/', [PosController::class, 'index'])->name('/');
    Route::view('login', 'login');
    Route::view('register', 'register')->name('register');
    Route::post('login', [PosController::class, 'login'])->name('login');
    Route::post('logout', [PosController::class, 'logout'])->name('logout');
    Route::post('register', [PosController::class, 'register'])->name('register_candidat');
    Route::get('profile',[candidatcontroller::class,'show_profile'])->name('profile');
    Route::get('/download_offre/{offre}', [PosController::class, 'download_offre'])->name('download_offre');
    Route::post('edit_candidat', [candidatcontroller::class, 'edit_candidat'])->name('edit_candidat');
    Route::get('offres',[candidatcontroller::class,'show_offres'])->name('offres');
    Route::post('postuler',[candidatcontroller::class,'postuler'])->name('postuler');
    Route::get('demandes',[candidatcontroller::class,'show_demandes'])->name('demandes');
    Route::post('delete_demande',[candidatcontroller::class,'delete_demande'])->name('delete_demande');
    Route::get('changer_passe',[candidatcontroller::class,'show_change_passe'])->name('changer_passe');
    Route::post('changepasse',[candidatcontroller::class,'change_passe'])->name('changepasse');
});

