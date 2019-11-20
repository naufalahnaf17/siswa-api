<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SiswaTagihanController extends Controller
{
    public function index($nis)
    {

      $tagihan = DB::table('sis_siswa')->where('nis' , $nis)->get();

      if (count($tagihan) > 0) {
        $res['Tagihan'] = $tagihan;
        return response($res);
      }else {
        return response('Terjadi Kesalahan');
      }

    }
}
