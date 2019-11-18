<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\SiswaHari;

class SiswaHariController extends Controller
{

  public function index()
  {

    $data = SiswaHari::where([
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
        'kode_hari' => 'required',
        'nama' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_hari = $request->input('kode_hari');
    $nama = $request->input('nama');
    $kode_pp = 'YSPTE05';
    $kode_lokasi = '12';
    $jam_awal = $request->input('jam_awal');
    $durasi = $request->input('durasi');

    $data = new SiswaHari;
    $data->kode_hari = $kode_hari;
    $data->nama = $nama;
    $data->kode_pp = $kode_pp;
    $data->kode_lokasi = $kode_lokasi;
    $data->jam_awal = $jam_awal;
    $data->durasi = $durasi;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function edit($kode_hari_edit,Request $request)
  {

    $validator = Validator::make($request->all(), [
        'kode_hari' => 'required',
        'nama' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_hari = $request->input('kode_hari');
    $nama = $request->input('nama');
    $kode_pp = 'YSPTE05';
    $kode_lokasi = '12';
    $jam_awal = $request->input('jam_awal');
    $durasi = $request->input('durasi');

    $data = SiswaHari::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['kode_hari', '=', $kode_hari_edit]
    ])->first();

    $data->kode_hari = $kode_hari;
    $data->nama = $nama;
    $data->kode_pp = $kode_pp;
    $data->kode_lokasi = $kode_lokasi;
    $data->jam_awal = $jam_awal;
    $data->durasi = $durasi;

    if ($data->save()) {
      $res['message'] = "Success Mengubah Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Mengubah Data";
      return response($res);
    }

  }

  public function hapus($kode_hari)
  {

    $data = SiswaHari::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['kode_hari', '=', $kode_hari]
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
