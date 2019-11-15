<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\DataKelas;

class DataKelasController extends Controller
{

    public function index()
    {

      $data = DataKelas::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05']
      ])->get();

      if ( count($data) > 0 ) {
        $res['message'] = "Success Mengambil Data";
        $res['value'] = $data;
        return response($res);
      }else {
        $res['message'] = "Data Tidak Ditemukan Atau Kosong Di Database";
      }

    }

    public function tambah(Request $request)
    {

      $validator = Validator::make($request->all(), [
          'kode_kelas' => 'required',
          'nama' => 'required',
          'kode_tingkat' => 'required',
          'kode_jur' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $kode_kelas = $request->input('kode_kelas');
      $nama = $request->input('nama');
      $kode_lokasi = '12';
      $kode_tingkat = $request->input('kode_tingkat');
      $kode_pp = 'YSPTE05';
      $kode_jur = $request->input('kode_jur');
      $flag_aktif = '1';

      $data = new DataKelas;
      $data->kode_kelas = $kode_kelas;
      $data->nama = $nama;
      $data->kode_lokasi = $kode_lokasi;
      $data->kode_tingkat = $kode_tingkat;
      $data->kode_pp = $kode_pp;
      $data->kode_jur = $kode_jur;
      $data->flag_aktif = $flag_aktif;

      if ($data->save()) {
        $res['message'] = "Success Menyimpan Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Menyimpan Data";
        return response($res);
      }

    }

    public function edit($kode_kelas_edit,Request $request)
    {

      $validator = Validator::make($request->all(), [
          'kode_kelas' => 'required',
          'nama' => 'required',
          'kode_tingkat' => 'required',
          'kode_jur' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $kode_kelas = $request->input('kode_kelas');
      $nama = $request->input('nama');
      $kode_lokasi = '12';
      $kode_tingkat = $request->input('kode_tingkat');
      $kode_pp = 'YSPTE05';
      $kode_jur = $request->input('kode_jur');
      $flag_aktif = '1';

      $data = DataKelas::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05'],
        ['kode_kelas', '=', $kode_kelas_edit]
      ])->first();

      $data->kode_kelas = $kode_kelas;
      $data->nama = $nama;
      $data->kode_lokasi = $kode_lokasi;
      $data->kode_tingkat = $kode_tingkat;
      $data->kode_pp = $kode_pp;
      $data->kode_jur = $kode_jur;
      $data->flag_aktif = $flag_aktif;

      if ($data->save()) {
        $res['message'] = "Success Mengubah Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Mengubah Data";
        return response($res);
      }


    }

}
