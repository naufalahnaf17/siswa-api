<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jadwal;

class JadwalController extends Controller
{

    public function jadwal()
    {

      $data = Jadwal::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05']
      ])->get();

      if (count($data) > 0 ) {

        $kelas_11 = Jadwal::where([
          ['kode_lokasi', '=', '12'],
          ['kode_pp', '=', 'yspte05'],
          ['kode_kelas', '=', 'XI-13RPL']
        ])->get();

        $res['kelas XI - RPL'] = $kelas_11;

        $kelas_2tkj = Jadwal::where([
          ['kode_lokasi', '=', '12'],
          ['kode_pp', '=', 'yspte05'],
          ['kode_kelas', '=', '2TKJ1']
        ])->get();

        $res['kelas 2TKJ1'] = $kelas_2tkj;

        $kelas_9TKJ = Jadwal::where([
          ['kode_lokasi', '=', '12'],
          ['kode_pp', '=', 'yspte05'],
          ['kode_kelas', '=', 'XI-9TKJ']
        ])->get();

        $res['kelas XI - TKJ'] = $kelas_9TKJ;



        return response($res);
      }else {
        $res['message'] = "Data Kosong";
        return response($res);
      }

    }

}
