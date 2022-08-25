<?php

use App\Http\Controllers\devAdmin\Admin;
use App\Http\Controllers\Login;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', [Login::class, 'login'])->name('control.login.login');
Route::post('/logout/confirmado', [Login::class, 'logout'])->name('control.login.logout');

Route::get('/home-devAdmin', [Admin::class, 'index'])->middleware('dev_admin')->name('view.devAdmin.home');
