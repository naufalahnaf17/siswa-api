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

    // Crud Siswa Status Siswa
    Route::get('status-siswa' , 'Api\SiswaStatusController@index');
    Route::post('status-siswa' , 'Api\SiswaStatusController@tambah');
    Route::put('status-siswa/{kode_ss}' , 'Api\SiswaStatusController@edit');
    Route::delete('status-siswa/{kode_ss}' , 'Api\SiswaStatusController@hapus');

    // Crud Siswa Slot Jam Belajar
    Route::get('siswa-jam' , 'Api\DataSlotJamController@index');
    Route::post('siswa-jam' , 'Api\DataSlotJamController@tambah');
    Route::put('siswa-jam/{kode_slot}' , 'Api\DataSlotJamController@edit');
    Route::delete('siswa-jam/{kode_slot}' , 'Api\DataSlotJamController@hapus');

    // Crud Siswa Jenis Penilaian
    Route::get('jenis-penilaian' , 'Api\JenisPenilaianController@index');
    Route::post('jenis-penilaian' , 'Api\JenisPenilaianController@tambah');
    Route::put('jenis-penilaian/{kode_jenis}' , 'Api\JenisPenilaianController@edit');
    Route::delete('jenis-penilaian/{kode_jenis}' , 'Api\JenisPenilaianController@hapus');

    // Crud Guru Status
    Route::get('guru-status' , 'Api\GuruStatusController@index');
    Route::post('guru-status' , 'Api\GuruStatusController@tambah');
    Route::put('guru-status/{kode_status}' , 'Api\GuruStatusController@edit');
    Route::delete('guru-status/{kode_status}' , 'Api\GuruStatusController@hapus');

    // Crud Siswa Mata Pelajaran
    Route::get('siswa-matpel' , 'Api\SiswaMatpelController@index');
    Route::post('siswa-matpel' , 'Api\SiswaMatpelController@tambah');
    Route::put('siswa-matpel/{kode_matpel}' , 'Api\SiswaMatpelController@edit');
    Route::delete('siswa-matpel/{kode_matpel}' , 'Api\SiswaMatpelController@hapus');

    // Crud Siswa KKM Nilai
    Route::get('siswa-kkm' , 'Api\SiswaKkmController@index');
    Route::post('siswa-kkm' , 'Api\SiswaKkmController@tambah');
    Route::put('siswa-kkm/{kode_matpel}/{kode_tingkat}' , 'Api\SiswaKkmController@edit');
    Route::delete('siswa-kkm/{kode_matpel}/{kode_tingkat}' , 'Api\SiswaKkmController@hapus');

    // Crud Guru Mata Pelajaran
    Route::get('guru-matpel' , 'Api\GuruMatpelController@index');
    Route::post('guru-matpel' , 'Api\GuruMatpelController@tambah');
    Route::put('guru-matpel/{nik}' , 'Api\GuruMatpelController@edit');
    Route::delete('guru-matpel/{nik}' , 'Api\GuruMatpelController@hapus');


    // Upload Image For Profile
    Route::get('file/download/{nama}' , 'Api\FileController@download');
    Route::post('file/upload' , 'Api\FileController@upload');

});
