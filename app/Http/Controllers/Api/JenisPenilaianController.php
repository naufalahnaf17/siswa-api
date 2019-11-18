<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\JenisPenilaian;

class JenisPenilaianController extends Controller
{

  public function index()
  {

    $data = JenisPenilaian::where([
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
        'kode_jenis' => 'required',
        'nama' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_jenis = $request->input('kode_jenis');
    $nama = $request->input('nama');
    $kode_lokasi = '12';
    $kode_pp = 'YSPTE05';
    $flag_aktif = '1';

    $data = new JenisPenilaian;
    $data->kode_jenis = $kode_jenis;
    $data->nama = $nama;
    $data->kode_lokasi = $kode_lokasi;
    $data->kode_pp = $kode_pp;
    $data->flag_aktif = $flag_aktif;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function edit($kode_jenis_edit , Request $request)
  {

    $validator = Validator::make($request->all(), [
        'kode_jenis' => 'required',
        'nama' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_jenis = $request->input('kode_jenis');
    $nama = $request->input('nama');
    $kode_lokasi = '12';
    $kode_pp = 'YSPTE05';
    $flag_aktif = '1';

    $data = JenisPenilaian::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['kode_jenis', '=', $kode_jenis_edit]
    ])->first();

    $data->kode_jenis = $kode_jenis;
    $data->nama = $nama;
    $data->kode_lokasi = $kode_lokasi;
    $data->kode_pp = $kode_pp;
    $data->flag_aktif = $flag_aktif;

    if ($data->save()) {
      $res['message'] = "Success Mengubah Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Mengubah Data";
      return response($res);
    }

  }

  public function hapus($kode_jenis)
  {

    $data = JenisPenilaian::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['kode_jenis', '=', $kode_jenis]
    ])->first();

    if($data->delete()){
      $res['message'] = "Success Menghapus Data";
      return response($res);
    }
    else{
        $res['message'] = "Terjadi Kesalahan Saat Menghapus Data";
        return response($res);
    }

  }

}
