<?php

use App\Http\Controllers\devAdmin\Admin;
use App\Http\Controllers\Login;
use App\Http\Controllers\User;
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


Route::group( [ 'prefix' => 'devAdmin/' ], function()
{
    Route::group( ['middleware' => 'dev_admin'], function()
    {
        Route::get('/', [Admin::class, 'index'])->name('view.devAdmin.home');
    });
});


Route::group( [ 'prefix' => 'user/' ], function()
{
    //empresa, area permita apenas para desenvolvedores, 
    Route::group( ['middleware' => ['dev_admin','dev_empregado']], function()
    {
        Route::get('/', [User::class, 'index'])->name('view.user.index');
        Route::post('/create', [User::class, 'cadastrar'])->name('control.user.cadastrar');
    });
});



