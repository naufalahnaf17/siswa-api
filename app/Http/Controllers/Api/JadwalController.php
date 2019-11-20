<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jadwal;

class JadwalController extends Controller
{

    public function index()
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

        $kelas_2tkj = Jadwal::where([
          ['kode_lokasi', '=', '12'],
          ['kode_pp', '=', 'yspte05'],
          ['kode_kelas', '=', '2TKJ1']
        ])->get();

        $kelas_9TKJ = Jadwal::where([
          ['kode_lokasi', '=', '12'],
          ['kode_pp', '=', 'yspte05'],
          ['kode_kelas', '=', 'XI-9TKJ']
        ])->get();

        $res['XI-RPL'] = $kelas_11->sis_slot->nama;
        return response($res);
        $res['XI-TKJ'] = $kelas_9TKJ;
        $res['2-TKJ'] = $kelas_2tkj;

        return response($res);
      }else {
        $res['message'] = "Data Kosong";
        return response($res);
      }

    }

}
