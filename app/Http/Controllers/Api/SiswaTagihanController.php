<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SiswaTagihanController extends Controller
{
    public function index($nis)
    {

      $nis_siswa = $nis;

      $tagihan = DB::table('sis_siswa')
      ->join('sis_siswa_tarif', function ($join) {
          $join->on('sis_siswa.nis', '=', 'sis_siswa_tarif.nis')
               ->where('sis_siswa_tarif' , '=' , $nis_siswa);
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
