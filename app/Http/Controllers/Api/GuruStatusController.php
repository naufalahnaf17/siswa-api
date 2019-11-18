<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\GuruStatus;

class GuruStatusController extends Controller
{

  public function index()
  {

    $data = GuruStatus::where([
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
        'kode_status' => 'required',
        'nama' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_status = $request->input('kode_status');
    $nama = $request->input('nama');
    $kode_lokasi = '12';
    $flag_aktif = '1';
    $kode_pp = 'YSPTE05';

    $data = new GuruStatus;
    $data->kode_status = $kode_status;
    $data->nama = $nama;
    $data->kode_lokasi = $kode_lokasi;
    $data->flag_aktif = $flag_aktif;
    $data->kode_pp = $kode_pp;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function edit($kode_status_edit , Request $request)
  {

    $validator = Validator::make($request->all(), [
        'kode_status' => 'required',
        'nama' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_status = $request->input('kode_status');
    $nama = $request->input('nama');
    $kode_lokasi = '12';
    $flag_aktif = '1';
    $kode_pp = 'YSPTE05';

    $data = GuruStatus::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['kode_status', '=', $kode_status_edit]
    ])->first();

    $data->kode_status = $kode_status;
    $data->nama = $nama;
    $data->kode_lokasi = $kode_lokasi;
    $data->flag_aktif = $flag_aktif;
    $data->kode_pp = $kode_pp;

    if ($data->save()) {
      $res['message'] = "Success Mengubah Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Mengubah Data";
      return response($res);
    }

  }

  public function hapus($kode_status)
  {

    $data = JenisPenilaian::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['kode_status', '=', $kode_status]
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
