<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PesanController extends Controller
{

    public function index(){
      $data = DB::table('cek_msg')->latest('pesan')->first();

      if ($data) {
        $res['value'] = $data;
        return response($res);
      }
      else {
        return response('Terjadi Kesalahan');
      }

    }

    public function send(Request $request){

      $data = DB::table('cek_msg')->insert([
  			'pesan' => $request->input('pesan')
  		]);

      if ($data) {
        return response('OK');
      }else {
        return response('terjadi Kesalahan');
      }

    }

}
