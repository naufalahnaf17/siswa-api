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

      $nama = $request->input('nama');
      $kode_slot = rand(4);
      return response($kode_slot);

      $data = new DataJam;
      $data->nama = $nama;


    }

}
