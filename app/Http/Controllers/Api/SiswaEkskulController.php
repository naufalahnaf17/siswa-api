<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\SiswaEkskul;

class SiswaEkskulController extends Controller
{

  public function index()
  {

    $data = SiswaEkskul::where([
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
        'no_bukti' => 'required',
        'nik_user' => 'required',
        'tgl_input' => 'required',
        'nis' => 'required',
        'tgl_mulai' => 'required',
        'tgl_selesai' => 'required',
        'keterangan' => 'required',
        'kode_jenis' => 'required',
        'predikat' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $no_bukti = $request->input('no_bukti');
    $nik_user = $request->input('nik_user');
    $tgl_input = $request->input('tgl_input');
    $kode_lokasi = '12';
    $kode_pp = 'YSPTE05';
    $nis = $request->input('nis');
    $tgl_mulai = $request->input('tgl_mulai');
    $tgl_selesai = $request->input('tgl_selesai');
    $keterangan = $request->input('keterangan');
    $kode_jenis = $request->input('kode_jenis');
    $predikat = $request->input('predikat');

    $data = new SiswaEkskul;
    $data->no_bukti = $no_bukti;
    $data->nik_user = $nik_user;
    $data->tgl_input = $tgl_input;
    $data->kode_lokasi = $kode_lokasi;
    $data->kode_pp = $kode_pp;
    $data->nis = $nis;
    $data->tgl_mulai = $tgl_mulai;
    $data->tgl_selesai = $tgl_selesai;
    $data->keterangan = $keterangan;
    $data->kode_jenis = $kode_jenis;
    $data->predikat = $predikat;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function edit($nis,$kode_jenis_edit,Request $request)
  {

    $validator = Validator::make($request->all(), [
        'no_bukti' => 'required',
        'nik_user' => 'required',
        'tgl_input' => 'required',
        'tgl_mulai' => 'required',
        'tgl_selesai' => 'required',
        'keterangan' => 'required',
        'kode_jenis' => 'required',
        'predikat' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $no_bukti = $request->input('no_bukti');
    $nik_user = $request->input('nik_user');
    $tgl_input = $request->input('tgl_input');
    $kode_lokasi = '12';
    $kode_pp = 'YSPTE05';
    $tgl_mulai = $request->input('tgl_mulai');
    $tgl_selesai = $request->input('tgl_selesai');
    $keterangan = $request->input('keterangan');
    $kode_jenis = $request->input('kode_jenis');
    $predikat = $request->input('predikat');

    $data = SiswaEkskul::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['nis', '=', $nis],
      ['kode_jenis', '=', $kode_jenis_edit]
    ])->first();

    $data->no_bukti = $no_bukti;
    $data->nik_user = $nik_user;
    $data->tgl_input = $tgl_input;
    $data->kode_lokasi = $kode_lokasi;
    $data->kode_pp = $kode_pp;
    $data->nis = $nis;
    $data->tgl_mulai = $tgl_mulai;
    $data->tgl_selesai = $tgl_selesai;
    $data->keterangan = $keterangan;
    $data->kode_jenis = $kode_jenis;
    $data->predikat = $predikat;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function hapus($nis,$kode_jenis)
  {

    $data = SiswaEkskul::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['nis', '=', $nis],
      ['kode_jenis', '=', $kode_jenis]
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
