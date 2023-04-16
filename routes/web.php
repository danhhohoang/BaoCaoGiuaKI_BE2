<?php

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

Route::get('dashboard', [userController::class, 'dashboard']);
Route::get('login', [userController::class, 'index'])->name('login');
Route::post('custom-login', [userController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [userController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [userController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [userController::class, 'signOut'])->name('signout');
