<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SiswaStatus;
use Validator;

class SiswaStatusController extends Controller
{

    public function index()
    {
      // Awal Ambil Data
      try {

        $data = SiswaStatus::where([
          ['kode_lokasi', '=', '12'],
          ['kode_pp', '=', 'yspte05']
        ])->get();

        if (count($data) > 0 ) {
          $res['message'] = "Success Mengambil Data";
          $res['value'] = $data;
          return response($res);
        }else {
          $res['message'] = "Data Kosong Di Dalam Database";
          return response($res);
        }

      } catch (\Exception $e) {
        return response('Data Kosong Di Dalam Database');
      }
      // Akhir Ambil Data

    }

    public function tambah(Request $request)
    {

      try {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $kode_ss = rand();
        $nama = $request->input('nama');
        $flag_aktif = '1';
        $kode_lokasi = '12';
        $kode_pp = 'YSPTE05';

        $data = new SiswaStatus;
        $data->kode_ss = $kode_ss;
        $data->nama = $nama;
        $data->flag_aktif = $flag_aktif;
        $data->kode_lokasi = $kode_lokasi;
        $data->kode_pp = $kode_pp;

        if ($data->save()) {
          $res['message'] = "Success Menyimpan Data";
          return response($res);
        }else {
          $res['message'] = "Gagal Menyimpan Data";
          return response($res);
        }

      } catch (\Exception $e) {
        return response('Terjadi Kesalahan : ' . $e);
      }

    }

    public function edit($kode_ss , Request $request)
    {

      try {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $nama = $request->input('nama');
        $flag_aktif = '1';
        $kode_lokasi = '12';
        $kode_pp = 'YSPTE05';

        $data = SiswaStatus::where([
          ['kode_lokasi', '=', '12'],
          ['kode_pp', '=', 'yspte05'],
          ['kode_ss', '=', $kode_ss]
        ])->first();
        $data->nama = $nama;
        $data->flag_aktif = $flag_aktif;
        $data->kode_lokasi = $kode_lokasi;
        $data->kode_pp = $kode_pp;

        if ($data->save()) {
          $res['message'] = "Success Mengubah Data";
          return response($res);
        }else {
          $res['message'] = "Gagal Mengubah Data";
          return response($res);
        }

      } catch (\Exception $e) {
          return response('Terjadi Kesalahan : ' . $e);
      }

    }

    public function hapus($kode_ss)
    {

      try {

        $data = SiswaStatus::where([
          ['kode_lokasi', '=', '12'],
          ['kode_pp', '=', 'yspte05'],
          ['kode_ss', '=', $kode_ss]
        ])->first();

        if ($data->delete()) {
          $res['message'] = "Success Menghapus Data";
          return response($res);
        }else {
          $res['message'] = "Gagal Menghapus Data";
          return response($res);
        }

      } catch (\Exception $e) {
        return response('Terjadi Kesalahan : ' .$e);
      }

    }

}
