<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataAngkatan;
use Validator;

class DataAngkatanController extends Controller
{

    public function index()
    {

      $data = DataAngkatan::where([
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
          'kode_akt' => 'required',
          'nama' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $kode_akt = $request->input('kode_akt');
      $kode_lokasi = '12';
      $kode_pp = 'YSPTE05';
      $kode_tingkat = '-';
      $flag_aktif = '0';
      $nama = $request->input('nama');

      $data = new DataAngkatan;
      $data->kode_akt = $kode_akt;
      $data->kode_lokasi = $kode_lokasi;
      $data->kode_pp = $kode_pp;
      $data->kode_tingkat = $kode_tingkat;
      $data->flag_aktif = $flag_aktif;
      $data->nama = $nama;

      if ($data->save()) {
        $res['message'] = "Success Menyimpan Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Menyimpan Data";
        return response($res);
      }

    }

    public function edit($satu,$dua,Request $request)
    {

      $validator = Validator::make($request->all(), [
          'kode_akt' => 'required',
          'nama' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $kode_akt = $request->input('kode_akt');
      $kode_lokasi = '12';
      $kode_pp = 'YSPTE05';
      $kode_tingkat = '-';
      $flag_aktif = '0';
      $nama = $request->input('nama');

      // Tahun Akt
      $tahun = $satu . '/' . $dua;
      // Tahun Akt

      $data = DataAngkatan::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05'],
        ['kode_akt', '=', $tahun]
      ])->first();

      $data->kode_akt = $kode_akt;
      $data->kode_lokasi = $kode_lokasi;
      $data->kode_pp = $kode_pp;
      $data->kode_tingkat = $kode_tingkat;
      $data->flag_aktif = $flag_aktif;
      $data->nama = $nama;

      if ($data->save()) {
        $res['message'] = "Success Mengubah Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Mengubah Data";
        return response($res);
      }

    }

    public function hapus($satu,$dua)
    {

      $tahun = $satu . '/' . $dua;

      $data = DataAngkatan::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05'],
        ['kode_akt', '=', $tahun]
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
