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

Route::get('/', function () {
    return redirect('login');
});
Route::get('/reset/password', 'Auth\LoginController@showLoginFormReset')->name('reset');
Route::post('/password', 'Auth\LoginController@resetPassword')->name('password');
Route::get('/password/recovery', 'Auth\LoginController@showLoginFormRecover')->name('recovery.get');
Route::post('/password/recovery', 'Auth\LoginController@recoverPassword')->name('recovery.post');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::resource('/users', 'UserController');
Route::put('/users/profile/{user}', 'UserController@profile');
Route::resource('clientes', 'CustomerController')->only('index');
Route::post('getClientes', 'CustomerController@show')->name('clientes.show');
Route::post('clientes', 'CustomerController@store')->name('clientes.store');

