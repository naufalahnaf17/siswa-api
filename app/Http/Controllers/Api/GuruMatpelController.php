<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\GuruMatpel;

class GuruMatpelController extends Controller
{

  public function index()
  {

    $data = GuruMatpel::where([
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
        'nik' => 'required',
        'kode_matpel' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_pp = 'YSPTE05';
    $nik = $request->input('nik');
    $kode_matpel = $request->input('kode_matpel');
    $kode_lokasi = '12';
    $kode_status = 'TP';
    $flag_aktif = '1';

    $data = new GuruMatpel;
    $data->kode_pp = $kode_pp;
    $data->nik = $nik;
    $data->kode_matpel = $kode_matpel;
    $data->kode_lokasi = $kode_lokasi;
    $data->kode_status = $kode_status;
    $data->flag_aktif = $flag_aktif;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function edit($nik_edit , Request $request)
  {

    $validator = Validator::make($request->all(), [
        'nik' => 'required',
        'kode_matpel' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_pp = 'YSPTE05';
    $nik = $request->input('nik');
    $kode_matpel = $request->input('kode_matpel');
    $kode_lokasi = '12';
    $kode_status = 'TP';
    $flag_aktif = '1';

    $data = GuruMatpel::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['nik', '=', $nik_edit]
    ])->first();

    $data->kode_pp = $kode_pp;
    $data->nik = $nik;
    $data->kode_matpel = $kode_matpel;
    $data->kode_lokasi = $kode_lokasi;
    $data->kode_status = $kode_status;
    $data->flag_aktif = $flag_aktif;

    if ($data->save()) {
      $res['message'] = "Success Mengubah Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Mengubah Data";
      return response($res);
    }

  }

  public function hapus($nik)
  {

    $data = GuruMatpel::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['nik', '=', $nik]
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
