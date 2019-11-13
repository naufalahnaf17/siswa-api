<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use App\Sis_Siswa;

class SiswaController extends Controller
{

    public function index(){

      $data = Sis_Siswa::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05']
      ])->get();

      if (count($data) > 0 ) {
        $res['message'] = "Success Mengambil Data";
        $res['value'] = $data;
        return response($res);
      }else {
        $res['message'] = "Data Kosong";
        return response($res);
      }

    }

    public function spesifik($nis){

      $data = Sis_Siswa::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05'],
        ['nis', '=', $nis]
      ])->get();

      if (count($data) > 0 ) {
        $res['message'] = "Success Mengambil Data";
        $res['value'] = $data;
        return response($res);
      }else {
        $res['message'] = "Data Tidak Di Temukan";
        return response($res);
      }

    }

    public function tambah(Request $request){

      $validator = Validator::make($request->all(), [
          'nis' => 'required',
          'kode_kelas' => 'required',
          'jurusan' => 'required'
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $nama = $request->input('nama');
      $jurusan = $request->input('jurusan');

      $data = new Siswa;
      $data->nama = $nama;
      $data->jurusan = $jurusan;

      if ($data->save()) {
        $res['message'] = "Success Menyimpan Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Menyimpan Data";
        return response($res);
      }

    }

    public function edit($nis , Request $request){

      $nama = $request->input('nama');
      $jurusan = $request->input('jurusan');

      $data = Siswa::find($nis);
      $data->nama = $nama;
      $data->jurusan = $jurusan;

      if ($data->save()) {
        $res['message'] = "Success Mengubah Data";
        return response($res);
      }else {
        $res['message'] = "Error 404";
        return response($res);
      }

    }

    public function hapus($nis){

      $data = Siswa::find($nis);
      if($data->delete()){
        $res['message'] = "Success!";
        return response($res);
      }
      else{
          $res['message'] = "Failed!";
          return response($res);
      }

    }

}
