<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\SiswaRaport;

class SiswaRaportController extends Controller
{

  public function index()
  {

    $data = SiswaRaport::where([
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
        'kode_ta' => 'required',
        'kode_sem' => 'required',
        'kode_kelas' => 'required',
        'nis' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $input = $request->all();
    $input['kode_lokasi'] = '12';
    $input['kode_pp'] = 'YSPTE05';
    $data = SiswaRaport::create($input);

    if ($data) {
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
        'kode_sem' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $input = $request->all();
    $data = SiswaRaport::where('nis',$nis_edit)->update(['kode_sem' => $input['kode_sem']]);

    if ($data) {
      $res['message'] = "Success Mengubah Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Mengubah Data";
      return response($res);
    }

  }

  public function hapus($nis)
  {

    $data = SiswaRaport::where([
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
