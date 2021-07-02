<?php

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

Route::get('/', 'Auth\AuthController@index')->name('login');
Route::post('/login', 'Auth\AuthController@check')->name('auth.check');
Route::get('/logout', 'Auth\AuthController@logout')->name('logout');
Route::get('/register', 'Auth\AuthController@regist_view')->name('register.index');
Route::post('/register_post', 'Auth\AuthController@register')->name('register.post');

Route::prefix('dashboard')->group(function () {
    Route::get('/dashboard', 'Dashboard\DsController@index')->name('ds.index');
});
