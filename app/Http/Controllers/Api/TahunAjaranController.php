<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TahunAjaran;
use Validator;

class TahunAjaranController extends Controller
{

    public function index()
    {

      $data = TahunAjaran::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05']
      ])->get();

      if ( count($data) > 0 ) {
        $res['message'] = "Success Mengambil Data";
        $res['value'] = $data;
        return response($res);
      }else {
        $res['message'] = "Data Tidak Ditemukan Atau Kosong Di Database";
      }

    }

    public function tambah(Request $request)
    {

      $validator = Validator::make($request->all(), [
          'kode_ta' => 'required',
          'tgl_mulai' => 'required',
          'tgl_akhir' => 'required',
          'nama' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $kode_ta = $request->input('kode_ta');
      $kode_pp = 'YSPTE05';
      $tgl_mulai = $request->input('tgl_mulai');
      $tgl_akhir = $request->input('tgl_akhir');
      $flag_aktif = '0';
      $kode_lokasi = '12';
      $nama = $request->input('nama');

      $data = new TahunAjaran;
      $data->kode_ta = $kode_ta;
      $data->kode_pp = $kode_pp;
      $data->tgl_mulai = $tgl_mulai;
      $data->tgl_akhir = $tgl_akhir;
      $data->flag_aktif = $flag_aktif;
      $data->kode_lokasi = $kode_lokasi;
      $data->nama = $nama;

      if ($data->save()) {
        $res['message'] = "Success Menyimpan Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Menyimpan Data";
        return response($res);
      }

    }

    public function edit($tgl_mulai , Request $request)
    {

      $kode_ta = $request->input('kode_ta');
      $kode_pp = 'YSPTE05';
      $tgl_akhir = $request->input('tgl_akhir');
      $flag_aktif = '0';
      $kode_lokasi = '12';
      $nama = $request->input('nama');

      $data = TahunAjaran::find($tgl_mulai);
      return response($data);
      $data->flag_aktif = $flag_aktif;

    }

}
