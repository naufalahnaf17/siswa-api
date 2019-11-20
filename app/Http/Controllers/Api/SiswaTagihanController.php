<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SiswaTagihanController extends Controller
{
    public function index($nis)
    {

      $tagihan = DB::table('sis_siswa')
      ->join('sis_siswa_tarif', function ($join) {
          $join->on('sis_siswa.nis', '=', 'sis_siswa_tarif.nis')
               ->where([
                 ['sis_siswa_tarif.kode_lokasi', '=', '12'],
                 ['sis_siswa_tarif.kode_pp', '=', 'yspte05'],
                 ['sis_siswa_tarif.nis', '=', $nis]
               ]);
      })
      ->get();

      if ($tagihan) {
        $res['Tagihan'] = $tagihan;
        return response($res);
      }else {
        return response('Terjadi Kesalahan');
      }

    }
}
