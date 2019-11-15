<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SiswaStatus;

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
        }

      } catch (\Exception $e) {
        return response('Data Kosong Di Dalam Database');
      }
      // Akhir Ambil Data

    }

}
