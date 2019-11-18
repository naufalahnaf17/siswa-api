<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\SiswaKalender;

class SiswaKalenderController extends Controller
{

  public function index()
  {

    $data = SiswaKalender::where([
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
        'tanggal' => 'required',
        'agenda' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_pp = 'YSPTE05';
    $kode_ta = $request->input('kode_ta');
    $kode_sem = $request->input('kode_sem');
    $kode_tingkat = $request->input('kode_tingkat');
    $tanggal = $request->input('tanggal');
    $agenda = $request->input('agenda');
    $kode_lokasi = '12';

    $data = new SiswaKalender;
    $data->kode_pp = $kode_pp;
    $data->kode_ta = $kode_ta;
    $data->kode_sem = $kode_sem;
    $data->kode_tingkat = $kode_tingkat;
    $data->tanggal = $tanggal;
    $data->agenda = $agenda;
    $data->kode_lokasi = $kode_lokasi;

    if ($data->save()) {
      $res['message'] = "Success Menyimpan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menyimpan Data";
      return response($res);
    }

  }

  public function edit($agenda_edit , Request $request)
  {

    $validator = Validator::make($request->all(), [
        'kode_ta' => 'required',
        'kode_sem' => 'required',
        'tanggal' => 'required',
        'agenda' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $kode_pp = 'YSPTE05';
    $kode_ta = $request->input('kode_ta');
    $kode_sem = $request->input('kode_sem');
    $kode_tingkat = $request->input('kode_tingkat');
    $tanggal = $request->input('tanggal');
    $agenda = $request->input('agenda');
    $kode_lokasi = '12';

    $data = SiswaKalender::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['agenda', 'LIKE', '%'.$agenda_edit.'%']
    ])->first();

    $data->kode_pp = $kode_pp;
    $data->kode_ta = $kode_ta;
    $data->kode_sem = $kode_sem;
    $data->kode_tingkat = $kode_tingkat;
    $data->tanggal = $tanggal;
    $data->agenda = $agenda;
    $data->kode_lokasi = $kode_lokasi;

    if ($data->save()) {
      $res['message'] = "Success Mengubah Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Mengubah Data";
      return response($res);
    }

  }

  public function hapus($agenda)
  {

    $data = SiswaKalender::where([
      ['kode_lokasi', '=', '12'],
      ['kode_pp', '=', 'yspte05'],
      ['agenda', 'LIKE', '%'.$agenda.'%']
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
