<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\SiswaNilai;

class SiswaNilaiController extends Controller
{

  public function index()
  {

    $data = SiswaNilai::where([
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
        'nis' => 'required',
        'nilai' => 'required',
        'no_bukti' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $nis = $request->input('nis');
    $nilai = $request->input('nilai');
    $kode_lokasi = '12';
    $kode_pp = 'YSPTE05';
    $no_bukti = $request->input('no_bukti');

    $data = new SiswaNilai;
    $data->nis = $nis;
    $data->nilai = $nilai;
    $data->kode_lokasi = $kode_lokasi;
    $data->kode_pp = $kode_pp;
    $data->no_bukti = $no_bukti;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function edit($nis , $no_bukti ,Request $request)
  {

    $validator = Validator::make($request->all(), [
        'nilai' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $nilai = $request->input('nilai');
    $kode_lokasi = '12';
    $kode_pp = 'YSPTE05';

    $data = SiswaNilai::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['nis', '=', $nis],
      ['no_bukti', '=', $no_bukti]
    ])->first();

    $data->nilai = $nilai;
    $data->kode_lokasi = $kode_lokasi;
    $data->kode_pp = $kode_pp;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function hapus($nis,$no_bukti)
  {

    $data = SiswaNilai::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['nis', '=', $nis],
      ['no_bukti', '=', $no_bukti]
    ])->first();

    if ($data->delete()) {
      $res['message'] = "Success Menghapus Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menghapus Data";
      return response($res);
    }

  }

}
