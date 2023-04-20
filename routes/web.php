<?php

use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('dashboard', [userController::class, 'dashboard'])->name('dashboard');
// Route::get('listuser', [userController::class, 'list']);
Route::get('login', [userController::class, 'index'])->name('login');
Route::post('custom-login', [userController::class, 'customLogin'])->name('login.custom');
Route::get('profile/{id}', [userController::class, 'profile'])->name('profile');
Route::get('registration', [userController::class, 'registration'])->name('register-user');
Route::get('delete/{id}', [userController::class, 'delete']);
Route::get('edit-user/{id}', [userController::class, 'editlayout']);
Route::post('edit/{id}', [userController::class, 'edit']);
Route::post('custom-registration', [userController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
