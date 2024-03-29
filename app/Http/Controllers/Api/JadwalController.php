<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jadwal;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{

    public function index()
    {

      $data = Jadwal::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05']
      ])->get();

      if (count($data) > 0 ) {

        $kelas_11 = DB::table('sis_jadwal')
        ->join('sis_slot', function ($join) {
            $join->on('sis_jadwal.kode_slot', '=', 'sis_slot.kode_slot')
                 ->where([
                   ['sis_jadwal.kode_lokasi', '=', '12'],
                   ['sis_jadwal.kode_pp', '=', 'yspte05'],
                   ['sis_jadwal.kode_kelas', '=', 'XI-13RPL']
                 ]);
        })
        ->join('karyawan', function ($kar) {
            $kar->on('sis_jadwal.nik', '=', 'karyawan.nik')
                 ->where([
                   ['sis_jadwal.kode_lokasi', '=', '12']
                 ]);
        })
        ->get();

        $kelas_2tkj = DB::table('sis_jadwal')
        ->join('sis_slot', function ($join) {
            $join->on('sis_jadwal.kode_slot', '=', 'sis_slot.kode_slot')
                 ->where([
                   ['sis_jadwal.kode_lokasi', '=', '12'],
                   ['sis_jadwal.kode_pp', '=', 'yspte05'],
                   ['sis_jadwal.kode_kelas', '=', '2TKJ1']
                 ]);
        })
        ->get();

        $kelas_9TKJ = DB::table('sis_jadwal')
        ->join('sis_slot', function ($join) {
            $join->on('sis_jadwal.kode_slot', '=', 'sis_slot.kode_slot')
                 ->where([
                   ['sis_jadwal.kode_lokasi', '=', '12'],
                   ['sis_jadwal.kode_pp', '=', 'yspte05'],
                   ['sis_jadwal.kode_kelas', '=', 'XI-9TKJ']
                 ]);
        })
        ->get();

        $res['XI-RPL'] = $kelas_11;
        $res['XI-TKJ'] = $kelas_9TKJ;
        $res['2-TKJ'] = $kelas_2tkj;
        return response($res);
      }else {
        $res['message'] = "Data Kosong";
        return response($res);
      }

    }

}
