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

// Login Register
Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

// Get Menu Siswa For Dashboard
Route::get('menu/{kode}' , 'Api\UserController@menu');
Route::get('mform/siswa' , 'Api\UserController@mformSiswa');
Route::get('mform/admin' , 'Api\UserController@mformAdmin');
Route::post('mform/tambah' , 'Api\UserController@tambahMform');
Route::delete('mform/delete/{kode_form}' , 'Api\UserController@deleteMform');


Route::group(['middleware' => 'auth:api'], function() {
    //Detail Account
    Route::post('details', 'Api\UserController@details');
    Route::post('details/{id}' , 'Api\UserController@set_profile');
    Route::post('add-detail' , 'Api\UserController@addDetail');
    Route::put('update-detail' , 'Api\UserController@updateDetail');

    // Crud Siswa
    Route::get('siswa','Api\SiswaController@index');
    Route::get('siswa/{nis}','Api\SiswaController@spesifik');
    Route::post('siswa','Api\SiswaController@tambah');
    Route::put('siswa/{nis}','Api\SiswaController@edit');
    Route::delete('siswa/{nis}','Api\SiswaController@hapus');

    // Crud Jadwal
    Route::get('jadwal' , 'Api\JadwalController@index');

    // Crud Tahun Ajaran
    Route::get('tahun-ajaran' , 'Api\TahunAjaranController@index');
    Route::post('tahun-ajaran' , 'Api\TahunAjaranController@tambah');
    Route::put('tahun-ajaran/{tgl_mulai}' , 'Api\TahunAjaranController@edit');
    Route::delete('tahun-ajaran/{tgl_mulai}' , 'Api\TahunAjaranController@hapus');

    // Crud Data Angkatan
    Route::get('data-angkatan' , 'Api\DataAngkatanController@index');
    Route::post('data-angkatan' , 'Api\DataAngkatanController@tambah');
    Route::put('data-angkatan/{satu}/{dua}' , 'Api\DataAngkatanController@edit');
    Route::delete('data-angkatan/{satu}/{dua}' , 'Api\DataAngkatanController@hapus');

    // Crud Siswa Data Jurusan
    Route::get('siswa-jurusan' , 'Api\SiswaJurusanController@index');
    Route::post('siswa-jurusan' , 'Api\SiswaJurusanController@tambah');
    Route::put('siswa-jurusan/{kode_jur_edit}' , 'Api\SiswaJurusanController@edit');
    Route::delete('siswa-jurusan/{kode_jur}' , 'Api\SiswaJurusanController@hapus');

    // Crud Siswa Data Kelas
    Route::get('siswa-kelas' , 'Api\DataKelasController@index');
    Route::post('siswa-kelas' , 'Api\DataKelasController@tambah');
    Route::put('siswa-kelas/{kode_kelas}' , 'Api\DataKelasController@edit');
    Route::delete('siswa-kelas/{kode_kelas}' , 'Api\DataKelasController@hapus');

    // Crud Siswa Status Siswa(Belum Ada Table Nya)

    // Crud Siswa Slot Jam Belajar
    Route::get('siswa-jam' , 'Api\DataSlotJamController@index');

    // Upload Image For Profile
    Route::get('file/download/{nama}' , 'Api\FileController@download');
    Route::post('file/upload' , 'Api\FileController@upload');

});
