<?php

/**
*
* @version 1.0
*
* @author Milan Gotera <milangotera@gmail.com>
* @copyright milangotera@gmail.com
*
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api', 'prefix' => '/'], function() {

	Route::get('/', function () {
	    return response()->json(["api v1"]);
	});

	Route::post('/login', 'ApiController@login')->name('api.login');

	Route::prefix('/polls')->middleware(['auth:api'])->group(function () {

		Route::get('/download', 'ApiController@download')->name('api.download');

		Route::post('/upload', 'ApiController@upload')->name('api.upload');

	});	

});
