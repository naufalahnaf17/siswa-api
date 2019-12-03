<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\TagihanSiswa;

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

    public function edit($nim_edit){

      $kode_lokasi = '12';

      $data = TagihanSiswa::where('nim' , '=' , $nim_edit)->first();
      $data->no_tagihan = $request->input('no_tagihan');
      $data->kode_lokasi = $kode_lokasi;
      $data->nim = $request->input('nim');
      $data->tanggal = $request->input('tanggal');
      $data->keterangan = $request->input('keterangan');
      $data->periode = $request->input('periode');

      if ($data->save()) {
        return response('Berhasil Mengubah Data',200);
      }else {
        return response('Gagal Mengubah Data',400);
      }

    }

    public function hapus($nim){

      $data = TagihanSiswa::where('nim','=',$nim)->first();

      if ($data->delete()) {
        return response('Berhasil Menghapus Data',200);
      }else {
        return response('Gagal Menghapus Data',400);
      }

    }

    public function spesifik($key){

      $data = Sis_Siswa::where('no_tagihan', $key)
      ->orWhere('nim', 'like', '%' . $key)
      ->orWhere('keterangan', 'like', '%' . $key)
      ->paginate(5);

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

}
