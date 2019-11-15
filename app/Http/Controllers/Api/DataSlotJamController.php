<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\DataJam;

class DataSlotJamController extends Controller
{

    public function index()
    {

      $data = DataJam::where([
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
          'nama' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $kode_slot = rand();
      $kode_pp = 'YSPTE05';
      $nama = $request->input('nama');
      $kode_lokasi = '12';
      $jam_ke = $request->input('jam_ke');

      $data = new DataJam;
      $data->kode_slot = $kode_slot;
      $data->kode_pp = $kode_pp;
      $data->nama = $nama;
      $data->kode_lokasi = $kode_lokasi;
      $data->jam_ke = $jam_ke;

      if ($data->save()) {
        $res['message'] = "Success Menyimpan Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Menyimpan Data";
        return response($res);
      }

    }

    public function edit($kode_slot,Request $request)
    {

      $validator = Validator::make($request->all(), [
          'nama' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $kode_pp = 'YSPTE05';
      $nama = $request->input('nama');
      $kode_lokasi = '12';
      $jam_ke = $request->input('jam_ke');

      $data = DataJam::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05'],
        ['kode_slot', '=', $kode_slot]
      ])->first();

      $data->kode_pp = $kode_pp;
      $data->nama = $nama;
      $data->kode_lokasi = $kode_lokasi;
      $data->jam_ke = $jam_ke;

      if ($data->save()) {
        $res['message'] = "Success Menyimpan Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Menyimpan Data";
        return response($res);
      }

    }

    public function hapus($kode_slot)
    {

      $data = DataJam::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05'],
        ['kode_slot', '=', $kode_slot]
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
