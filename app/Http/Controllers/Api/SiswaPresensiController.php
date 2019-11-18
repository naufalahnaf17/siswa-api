<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\SiswaPresensi;

class SiswaPresensiController extends Controller
{

  public function index()
  {

    $data = SiswaPresensi::where([
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
        'kode_kelas' => 'required',
        'tanggal' => 'required',
        'tgl_input' => 'required',
        'nis' => 'required',
        'status' => 'required',
        'keterangan' => 'required',
        'jenis_absen' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_ta = $request->input('kode_ta');
    $kode_kelas = $request->input('kode_kelas');
    $tanggal = $request->input('tanggal');
    $tgl_input = $request->input('tgl_input');
    $nis = $request->input('nis');
    $status = $request->input('status');
    $keterangan = $request->input('keterangan');
    $kode_lokasi = '12';
    $kode_pp = 'YSPTE05';
    $nik = $request->input('nik');
    $jenis_absen = $request->input('jenis_absen');
    $kode_matpel = $request->input('kode_matpel');

    $data = new SiswaPresensi;
    $data->kode_ta = $kode_ta;
    $data->kode_kelas = $kode_kelas;
    $data->tanggal = $tanggal;
    $data->tgl_input = $tgl_input;
    $data->nis = $nis;
    $data->status = $status;
    $data->keterangan = $keterangan;
    $data->kode_lokasi = $kode_lokasi;
    $data->kode_pp = $kode_pp;
    $data->nik = $nik;
    $data->jenis_absen = $jenis_absen;
    $data->kode_matpel = $kode_matpel;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function edit($nis_edit,Request $request)
  {

    $validator = Validator::make($request->all(), [
        'kode_ta' => 'required',
        'kode_kelas' => 'required',
        'tanggal' => 'required',
        'tgl_input' => 'required',
        'status' => 'required',
        'keterangan' => 'required',
        'jenis_absen' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_ta = $request->input('kode_ta');
    $kode_kelas = $request->input('kode_kelas');
    $tanggal = $request->input('tanggal');
    $tgl_input = $request->input('tgl_input');
    $status = $request->input('status');
    $keterangan = $request->input('keterangan');
    $kode_lokasi = '12';
    $kode_pp = 'YSPTE05';
    $nik = $request->input('nik');
    $jenis_absen = $request->input('jenis_absen');
    $kode_matpel = $request->input('kode_matpel');

    $data = SiswaPresensi::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['nis', '=', $nis_edit]
    ])->first();

    $data->kode_ta = $kode_ta;
    $data->kode_kelas = $kode_kelas;
    $data->tanggal = $tanggal;
    $data->tgl_input = $tgl_input;
    $data->status = $status;
    $data->keterangan = $keterangan;
    $data->kode_lokasi = $kode_lokasi;
    $data->kode_pp = $kode_pp;
    $data->nik = $nik;
    $data->jenis_absen = $jenis_absen;
    $data->kode_matpel = $kode_matpel;

    if ($data->save()) {
      $res['message'] = "Success Mengubah Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Mengubah Data";
      return response($res);
    }

  }

  public function hapus($nis)
  {

    $data = SiswaPresensi::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['nis', '=', $nis]
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
