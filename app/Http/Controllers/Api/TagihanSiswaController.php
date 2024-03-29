<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\TagihanSiswa;
use Illuminate\Support\Facades\DB;

class TagihanSiswaController extends Controller
{

    public function index(){

      $data = TagihanSiswa::paginate(15);

      if (count($data) > 0) {
        $res['message'] = 'Berhasil Ambil Data';
        $res['value'] = $data;
        return response($res,200);
      }else {
        return response('Data Di Database Kosong',400);
      }

    }

    public function tambah(Request $request){

      $kode_lokasi = '12';

      $data = new TagihanSiswa;
      $data->no_tagihan = $request->input('no_tagihan');
      $data->kode_lokasi = $kode_lokasi;
      $data->nim = $request->input('nim');
      $data->tanggal = $request->input('tanggal');
      $data->keterangan = $request->input('keterangan');
      $data->periode = $request->input('periode');

      if ($data->save()) {
        return response('Berhasil Menyimpan Data',200);
      }else {
        return response('Gagal Menyimpan Data',400);
      }

    }

    public function edit($no_tagihan_edit,Request $request){

      $kode_lokasi = '12';

      $data = DB::table('dev_tagihan_m')->where('no_tagihan',$no_tagihan_edit)->update([
        'no_tagihan' => $request->input('no_tagihan'),
        'kode_lokasi' => $kode_lokasi,
        'nim' => $request->input('nim'),
        'tanggal' => $request->input('tanggal'),
        'keterangan' => $request->input('keterangan'),
        'periode' => $request->input('periode')
      ]);

      if ($data) {
        return response('Berhasil Mengubah Data',200);
      }else {
        return response('Gagal Mengubah Data',400);
      }

    }

    public function hapus($no_tagihan){

      $data = DB::table('dev_tagihan_m')->where('no_tagihan',$no_tagihan)->delete();

      if ($data) {
        return response('Berhasil Menghapus Data',200);
      }else {
        return response('Gagal Menghapus Data',400);
      }

    }

    public function spesifik($key){

      $data = TagihanSiswa::where('no_tagihan', $key)
      ->orWhere('nim', 'like', '%' . $key . '%')
      ->orWhere('keterangan', 'like', '%' . $key . '%')
      ->get();

      if ($data) {
        $res['message'] = "Success Mengambil Data";
        $res['value'] = $data;
        return response($res);
      }else {
        $res['message'] = "Data Tidak Di Temukan";
        return response($res);
      }

    }

    public function entry($key){

      $data = TagihanSiswa::paginate($key);

      if (count($data) > 0 ) {
        $res['message'] = "Success Mengambil Data";
        $res['value'] = $data;
        return response($res);
      }else {
        $res['message'] = "Data Kosong";
        return response($res);
      }

    }

    public function dataEdit($no_tagihan){

      $data = TagihanSiswa::where('no_tagihan',$no_tagihan)->first();

      if ($data) {
        return response($data,200);
      }else {
        return response('Terjadi kesalahaan');
      }

    }

}
