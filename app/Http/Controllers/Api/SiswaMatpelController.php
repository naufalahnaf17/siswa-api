<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\SiswaMatpel;

class SiswaMatpelController extends Controller
{

  public function index()
  {

    $data = SiswaMatpel::where([
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
        'kode_matpel' => 'required',
        'nama' => 'required',
        'sifat' => 'required',
        'keterangan' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_matpel = $request->input('kode_matpel');
    $nama = $request->input('nama');
    $kode_pp = 'YSPTE05';
    $flag_aktif = '1';
    $sifat = $request->input('sifat');
    $keterangan = $request->input('keterangan');
    $kode_lokasi = '12';
    $kkm = $request->input('kkm');
    $kode_jenis = $request->input('kode_jenis');
    $kode_jur = $request->input('kode_jur');

    $data = new SiswaMatpel;
    $data->kode_matpel = $kode_matpel;
    $data->nama = $nama;
    $data->kode_pp = $kode_pp;
    $data->flag_aktif = $flag_aktif;
    $data->sifat = $sifat;
    $data->keterangan = $keterangan;
    $data->kode_lokasi = $kode_lokasi;
    $data->kkm = $kkm;
    $data->kode_jenis = $kode_jenis;
    $data->kode_jur = $kode_jur;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function edit($kode_matpel_edit , Request $request)
  {

    $validator = Validator::make($request->all(), [
        'kode_matpel' => 'required',
        'nama' => 'required',
        'sifat' => 'required',
        'keterangan' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_matpel = $request->input('kode_matpel');
    $nama = $request->input('nama');
    $kode_pp = 'YSPTE05';
    $flag_aktif = '1';
    $sifat = $request->input('sifat');
    $keterangan = $request->input('keterangan');
    $kode_lokasi = '12';
    $kkm = $request->input('kkm');
    $kode_jenis = $request->input('kode_jenis');
    $kode_jur = $request->input('kode_jur');

    $data = SiswaMatpel::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['kode_matpel', '=', $kode_matpel_edit]
    ])->first();

    $data->kode_matpel = $kode_matpel;
    $data->nama = $nama;
    $data->kode_pp = $kode_pp;
    $data->flag_aktif = $flag_aktif;
    $data->sifat = $sifat;
    $data->keterangan = $keterangan;
    $data->kode_lokasi = $kode_lokasi;
    $data->kkm = $kkm;
    $data->kode_jenis = $kode_jenis;
    $data->kode_jur = $kode_jur;

    if ($data->save()) {
      $res['message'] = "Success Mengubah Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Mengubah Data";
      return response($res);
    }

  }

  public function hapus($kode_matpel)
  {

    $data = SiswaMatpel::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['kode_matpel', '=', $kode_matpel]
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
