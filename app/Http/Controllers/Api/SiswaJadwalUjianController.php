<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
Use App\SiswaJdwlUjian;

class SiswaJadwalUjianController extends Controller
{

  public function index()
  {

    $data = SiswaJdwlUjian::where([
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
        'kode_ta' => 'required',
        'kode_sem' => 'required',
        'kode_tingkat' => 'required',
        'kode_jenis' => 'required',
        'tanggal' => 'required',
        'jam' => 'required',
        'kode_matpel' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_pp = 'YSPTE05';
    $kode_ta = $request->input('kode_ta');
    $kode_sem = $request->input('kode_sem');
    $kode_tingkat = $request->input('kode_tingkat');
    $kode_jenis = $request->input('kode_jenis');
    $tanggal = $request->input('tanggal');
    $jam = $request->input('jam');
    $kode_matpel = $request->input('kode_matpel');
    $kode_lokasi = '12';

    $data = new SiswaJdwlUjian;
    $data->kode_pp = $kode_pp;
    $data->kode_ta = $kode_ta;
    $data->kode_sem = $kode_sem;
    $data->kode_tingkat = $kode_tingkat;
    $data->kode_jenis = $kode_jenis;
    $data->tanggal = $tanggal;
    $data->jam = $jam;
    $data->kode_matpel = $kode_matpel;
    $data->kode_lokasi = $kode_lokasi;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function edit($tanggal_edit, $kode_matpel_edit ,Request $request)
  {

    $validator = Validator::make($request->all(), [
        'kode_ta' => 'required',
        'kode_sem' => 'required',
        'kode_tingkat' => 'required',
        'kode_jenis' => 'required',
        'tanggal' => 'required',
        'jam' => 'required',
        'kode_matpel' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_pp = 'YSPTE05';
    $kode_ta = $request->input('kode_ta');
    $kode_sem = $request->input('kode_sem');
    $kode_tingkat = $request->input('kode_tingkat');
    $kode_jenis = $request->input('kode_jenis');
    $tanggal = $request->input('tanggal');
    $jam = $request->input('jam');
    $kode_matpel = $request->input('kode_matpel');
    $kode_lokasi = '12';

    $data = SiswaJdwlUjian::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['tanggal', '=', $tanggal_edit],
      ['kode_matpel', '=', $kode_matpel_edit]
    ])->first();

    $data->kode_pp = $kode_pp;
    $data->kode_ta = $kode_ta;
    $data->kode_sem = $kode_sem;
    $data->kode_tingkat = $kode_tingkat;
    $data->kode_jenis = $kode_jenis;
    $data->tanggal = $tanggal;
    $data->jam = $jam;
    $data->kode_matpel = $kode_matpel;
    $data->kode_lokasi = $kode_lokasi;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function hapus($tanggal,$kode_matpel)
  {

    $data = SiswaJdwlUjian::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['tanggal', '=', $tanggal],
      ['kode_matpel', '=', $kode_matpel]
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
