<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{

  public function download($nama){
    $data = $nama;

    try {
      return response()->download({{ url('/' . $data) }});
    } catch (\Exception $e) {
      return response('Data Tidak Di Temukan');
    }

  }

  public function upload(Request $request){
    $photo = $request->file('photo');
    $ektensi = $photo->extension();
    try {
      if ($ektensi === 'png' || $ektensi === 'jpg' ) {
        $filename = str_random(10).'.'.$ektensi;
        $path = $request->file('photo')->move(('/') , $filename);
        $photoURL = url('/api/file/download/'.$filename);
        $res['url'] = $photoURL;
        return response($res);
      }else {
        return response('File Bukan Image');
      }
    } catch (\Exception $e) {
       return response($e);
    }

  }

}
