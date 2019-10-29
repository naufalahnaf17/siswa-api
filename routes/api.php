<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::group(['middleware' => 'auth:api'], function() {
    //Detail Account
    Route::post('details', 'Api\UserController@details');

    // Crud Siswa
    Route::get('siswa','Api\SiswaController@index');
    Route::post('siswa','Api\SiswaController@tambah');
    Route::put('siswa/{id}','Api\SiswaController@edit');
    Route::delete('siswa/{id}','Api\SiswaController@hapus');
});
