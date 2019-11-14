<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sis_Jur;
use Validator;

class SiswaJurusanController extends Controller
{

    public function index()
    {

      $data = Sis_Jur::where([
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

    public function tambah(Request $request)
    {

      $validator = Validator::make($request->all(), [
          'kode_jur' => 'required',
          'nama' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $kode_jur = $request->input('kode_jur');
      $kode_lokasi = '12';
      $kode_pp = 'YSPTE05';
      $nama = $request->input('nama');

      $data = new Sis_Jur;
      $data->kode_jur = $kode_jur;
      $data->kode_lokasi = $kode_lokasi;
      $data->kode_pp = $kode_pp;
      $data->nama = $nama;

      if ($data->save()) {
        $res['message'] = "Success Menyimpan Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Menyimpan Data";
        return response($res);
      }

    }

    public function edit($nama_edit,Request $request)
    {

      $validator = Validator::make($request->all(), [
          'nama' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $nama = $request->input('nama');

      $data = Sis_Jur::where('nama' , '=' , $nama_edit)->get();
      $data->nama = $nama;

      if ($data->save()) {
        $res['message'] = "Success Mengubah Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Mengubah Data";
        return response($res);
      }

    }

}
