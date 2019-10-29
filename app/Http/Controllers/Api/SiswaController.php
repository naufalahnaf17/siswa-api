<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use App\Siswa;

class SiswaController extends Controller
{

    public function index(){

      $data = Siswa::all();
      if (count($data) > 0 ) {
        $res['message'] = "Success Mengambil Data";
        $res['value'] = $data;
        return response($res);
      }else {
        $res['message'] = "Data Kosong";
        return response($res);
      }

    }

    public function tambah(Request $request){

      $validator = Validator::make($request->all(), [
          'nama' => 'required',
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

    public function edit($id , Request $request){

      $nama = $request->input('nama');
      $jurusan = $request->input('jurusan');

      $data = Siswa::find($id);
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

    public function hapus($id){

      $data = Siswa::find($id);
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
