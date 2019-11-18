<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\SiswaKkm;

class SiswaKkmController extends Controller
{

  public function index()
  {

    $data = SiswaKkm::where([
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
        'kode_tingkat' => 'required',
        'kkm' => 'required',
        'kode_matpel' => 'required',
        'kode_kkm' => 'required',
        'kode_jur' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_ta = $request->input('kode_ta');
    $kode_tingkat = $request->input('kode_tingkat');
    $kode_lokasi = '12';
    $kode_pp = 'YSPTE05';
    $kkm = $request->input('kkm');
    $kode_matpel = $request->input('kode_matpel');
    $flag_aktif = '1';
    $kode_kkm = $request->input('kode_kkm');
    $kode_jur = $request->input('kode_jur');
    $sem = $request->input('sem');

    $data = new SiswaKkm;
    $data->kode_ta = $kode_ta;
    $data->kode_tingkat = $kode_tingkat;
    $data->kode_lokasi = $kode_lokasi;
    $data->kode_pp = $kode_pp;
    $data->kkm = $kkm;
    $data->kode_matpel = $kode_matpel;
    $data->flag_aktif = $flag_aktif;
    $data->kode_kkm = $kode_kkm;
    $data->kode_jur = $kode_jur;
    $data->sem = $sem;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function edit($kode_matpel_edit , $kode_tingkat_edit , Request $request)
  {

    $validator = Validator::make($request->all(), [
        'kode_ta' => 'required',
        'kode_tingkat' => 'required',
        'kkm' => 'required',
        'kode_matpel' => 'required',
        'kode_kkm' => 'required',
        'kode_jur' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_ta = $request->input('kode_ta');
    $kode_tingkat = $request->input('kode_tingkat');
    $kode_lokasi = '12';
    $kode_pp = 'YSPTE05';
    $kkm = $request->input('kkm');
    $kode_matpel = $request->input('kode_matpel');
    $flag_aktif = '1';
    $kode_kkm = $request->input('kode_kkm');
    $kode_jur = $request->input('kode_jur');
    $sem = $request->input('sem');

    $data = SiswaKkm::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['kode_matpel', '=', $kode_matpel_edit],
      ['kode_tingkat', '=', $kode_tingkat_edit]
    ])->first();

    $data->kode_ta = $kode_ta;
    $data->kode_tingkat = $kode_tingkat;
    $data->kode_lokasi = $kode_lokasi;
    $data->kode_pp = $kode_pp;
    $data->kkm = $kkm;
    $data->kode_matpel = $kode_matpel;
    $data->flag_aktif = $flag_aktif;
    $data->kode_kkm = $kode_kkm;
    $data->kode_jur = $kode_jur;
    $data->sem = $sem;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function hapus($kode_matpel ,  $kode_tingkat)
  {

    $data = SiswaKkm::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['kode_matpel', '=', $kode_matpel],
      ['kode_tingkat', '=', $kode_tingkat]
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
