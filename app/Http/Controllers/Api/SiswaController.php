<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use App\Sis_Siswa;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{

    public function index(){

      $data = Sis_Siswa::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05']
      ])->get();

      if (count($data) > 0 ) {
        $res['message'] = "Success Mengambil Data";
        $res['value'] = $data;
        return response($res);
      }else {
        $res['message'] = "Data Kosong";
        return response($res);
      }

    }

    public function spesifik($nis){

      $data = Sis_Siswa::where('nis', $nis)
      ->orWhere('nis', 'like', '%' . $nis . '%')
      ->orWhere('nama', 'like', '%' . $nis . '%')
      ->orWhere('kode_kelas', 'like', '%' . $nis . '%')
      ->paginate(10);

      if ($data) {
        $res['message'] = "Success Mengambil Data";
        $res['value'] = $data;
        return response($res);
      }else {
        $res['message'] = "Data Tidak Di Temukan";
        return response($res);
      }

    }

    public function tambah(Request $request){

      $validator = Validator::make($request->all(), [
          'nis' => 'required',
          'kode_kelas' => 'required',
          'nama' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $nis = $request->input('nis');
      $flag_aktif = '1';
      $kode_kelas = $request->input('kode_kelas');
      $kode_akt = now()->year;
      $tgl_lulus = $request->input('tgl_lulus');
      $no_reg = $request->input('no_reg');
      $kode_ta = $request->input('kode_ta');
      $kode_pp = 'YSPTE05';
      $tanggal = $request->input('tanggal');
      $nama = $request->input('nama');
      $tmp_lahir = $request->input('tmp_lahir');
      $tgl_lahir = $request->input('tgl_lahir');
      $jk = $request->input('jk');
      $agama = $request->input('agama');
      $kwn = $request->input('kwn');
      $tlp_siswa = $request->input('tlp_siswa');
      $hp_siswa = $request->input('hp_siswa');
      $email = $request->input('email');
      $asal_sek = $request->input('asal_sek');
      $no_ijazah = $request->input('no_ijazah');
      $nilai_un = $request->input('nilai_un');
      $foto = $request->input('foto');
      $alamat_siswa = $request->input('alamat_siswa');
      $nama_ayah = $request->input('nama_ayah');
      $alamat_ayah = $request->input('alamat_ayah');
      $pdd_ayah = $request->input('pdd_ayah');
      $kerja_ayah = $request->input('kerja_ayah');
      $hasil_ayah = $request->input('hasil_ayah');
      $hp_ayah = $request->input('hp_ayah');
      $email_ayah = $request->input('email_ayah');
      $nama_ibu = $request->input('nama_ibu');
      $alamat_ibu = $request->input('alamat_ibu');
      $pdd_ibu = $request->input('pdd_ibu');
      $kerja_ibu = $request->input('kerja_ibu');
      $hasil_ibu = $request->input('hasil_ibu');
      $hp_ibu = $request->input('hp_ibu');
      $email_ibu = $request->input('email_ibu');
      $nama_wali = $request->input('nama_wali');
      $alamat_wali = $request->input('alamat_wali');
      $kerja_wali = $request->input('kerja_wali');
      $hp_wali = $request->input('hp_wali');
      $email_wali = $request->input('email_wali');
      $hub_wali = $request->input('hub_wali');
      $sdr_nama = $request->input('sdr_nama');
      $sdr_kelas = $request->input('sdr_kelas');
      $gol_darah = $request->input('gol_darah');
      $kond_kes = $request->input('kond_kes');
      $kond_obat = $request->input('kond_obat');
      $dokter_klg = $request->input('dokter_klg');
      $telp_dokter = $request->input('telp_dokter');
      $kode_lokasi = '12';
      $id_bank = $request->input('id_bank');

      $data = new Sis_Siswa;
      $data->nis = $nis;
      $data->flag_aktif = $flag_aktif;
      $data->kode_kelas = $kode_kelas;
      $data->kode_akt = $kode_akt;
      $data->tgl_lulus = $tgl_lulus;
      $data->no_reg = $no_reg;
      $data->kode_ta = $kode_ta;
      $data->kode_pp = $kode_pp;
      $data->tanggal = $tanggal;
      $data->nama = $nama;
      $data->tmp_lahir = $tmp_lahir;
      $data->tgl_lahir = $tgl_lahir;
      $data->jk = $jk;
      $data->agama = $agama;
      $data->kwn = $kwn;
      $data->tlp_siswa = $tlp_siswa;
      $data->hp_siswa = $hp_siswa;
      $data->email = $email;
      $data->asal_sek = $asal_sek;
      $data->no_ijazah = $no_ijazah;
      $data->nilai_un = $nilai_un;
      $data->foto = $foto;
      $data->alamat_siswa = $alamat_siswa;
      $data->nama_ayah = $nama_ayah;
      $data->alamat_ayah = $alamat_ayah;
      $data->pdd_ayah = $pdd_ayah;
      $data->kerja_ayah = $kerja_ayah;
      $data->hasil_ayah = $hasil_ayah;
      $data->hp_ayah = $hp_ayah;
      $data->email_ayah = $email_ayah;
      $data->nama_ibu = $nama_ibu;
      $data->alamat_ibu = $alamat_ibu;
      $data->pdd_ibu = $pdd_ibu;
      $data->kerja_ibu = $kerja_ibu;
      $data->hasil_ibu = $hasil_ibu;
      $data->hp_ibu = $hp_ibu;
      $data->email_ibu = $email_ibu;
      $data->nama_wali = $nama_wali;
      $data->alamat_wali = $alamat_wali;
      $data->kerja_wali = $kerja_wali;
      $data->hp_wali = $hp_wali;
      $data->email_wali = $email_wali;
      $data->hub_wali = $hub_wali;
      $data->sdr_nama = $sdr_nama;
      $data->sdr_kelas = $sdr_kelas;
      $data->gol_darah = $gol_darah;
      $data->kond_kes = $kond_kes;
      $data->kond_obat = $kond_obat;
      $data->dokter_klg = $dokter_klg;
      $data->telp_dokter = $telp_dokter;
      $data->kode_lokasi = $kode_lokasi;
      $data->id_bank = $id_bank;

      if ($data->save()) {
        $penampung_nama = strtolower($nama);
        $nama_asli_siswa = str_replace(' ', '', $penampung_nama);

        $input = $request->all();
        $input['name'] = $nama_asli_siswa;
        $input['email'] = $nama_asli_siswa.'@gmail.com';
        $input['password'] = bcrypt($nis);
        $input['url_photo'] = 'http://laravel.simkug.com/siswa-api/public/api/file/download/ML5nbHMEzI.png';
        $input['kode_menu'] = 'SISWA';
        $input['nis'] = $nis;
        $user = User::create($input);

        if ($user) {
          $res['message'] = "Success Menyimpan Data";
          return response($res);
        }
      }else {
        $res['message'] = "Gagal Menyimpan Data";
        return response($res);
      }

    }

    public function edit($nis , Request $request){

      $flag_aktif = '1';
      $kode_kelas = $request->input('kode_kelas');
      $kode_akt = now()->year;
      $tgl_lulus = $request->input('tgl_lulus');
      $no_reg = $request->input('no_reg');
      $kode_ta = $request->input('kode_ta');
      $kode_pp = 'YSPTE05';
      $tanggal = $request->input('tanggal');
      $nama = $request->input('nama');
      $tmp_lahir = $request->input('tmp_lahir');
      $tgl_lahir = $request->input('tgl_lahir');
      $jk = $request->input('jk');
      $agama = $request->input('agama');
      $kwn = $request->input('kwn');
      $tlp_siswa = $request->input('tlp_siswa');
      $hp_siswa = $request->input('hp_siswa');
      $email = $request->input('email');
      $asal_sek = $request->input('asal_sek');
      $no_ijazah = $request->input('no_ijazah');
      $nilai_un = $request->input('nilai_un');
      $foto = $request->input('foto');
      $alamat_siswa = $request->input('alamat_siswa');
      $nama_ayah = $request->input('nama_ayah');
      $alamat_ayah = $request->input('alamat_ayah');
      $pdd_ayah = $request->input('pdd_ayah');
      $kerja_ayah = $request->input('kerja_ayah');
      $hasil_ayah = $request->input('hasil_ayah');
      $hp_ayah = $request->input('hp_ayah');
      $email_ayah = $request->input('email_ayah');
      $nama_ibu = $request->input('nama_ibu');
      $alamat_ibu = $request->input('alamat_ibu');
      $pdd_ibu = $request->input('pdd_ibu');
      $kerja_ibu = $request->input('kerja_ibu');
      $hasil_ibu = $request->input('hasil_ibu');
      $hp_ibu = $request->input('hp_ibu');
      $email_ibu = $request->input('email_ibu');
      $nama_wali = $request->input('nama_wali');
      $alamat_wali = $request->input('alamat_wali');
      $kerja_wali = $request->input('kerja_wali');
      $hp_wali = $request->input('hp_wali');
      $email_wali = $request->input('email_wali');
      $hub_wali = $request->input('hub_wali');
      $sdr_nama = $request->input('sdr_nama');
      $sdr_kelas = $request->input('sdr_kelas');
      $gol_darah = $request->input('gol_darah');
      $kond_kes = $request->input('kond_kes');
      $kond_obat = $request->input('kond_obat');
      $dokter_klg = $request->input('dokter_klg');
      $telp_dokter = $request->input('telp_dokter');
      $kode_lokasi = '12';
      $id_bank = $request->input('id_bank');

      // Edit Data Function
      $data = Sis_Siswa::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05'],
        ['nis', '=', $nis]
      ])->first();

      $data->flag_aktif = $flag_aktif;
      $data->kode_kelas = $kode_kelas;
      $data->kode_akt = $kode_akt;
      $data->tgl_lulus = $tgl_lulus;
      $data->no_reg = $no_reg;
      $data->kode_ta = $kode_ta;
      $data->kode_pp = $kode_pp;
      $data->tanggal = $tanggal;
      $data->nama = $nama;
      $data->tmp_lahir = $tmp_lahir;
      $data->tgl_lahir = $tgl_lahir;
      $data->jk = $jk;
      $data->agama = $agama;
      $data->kwn = $kwn;
      $data->tlp_siswa = $tlp_siswa;
      $data->hp_siswa = $hp_siswa;
      $data->email = $email;
      $data->asal_sek = $asal_sek;
      $data->no_ijazah = $no_ijazah;
      $data->nilai_un = $nilai_un;
      $data->foto = $foto;
      $data->alamat_siswa = $alamat_siswa;
      $data->nama_ayah = $nama_ayah;
      $data->alamat_ayah = $alamat_ayah;
      $data->pdd_ayah = $pdd_ayah;
      $data->kerja_ayah = $kerja_ayah;
      $data->hasil_ayah = $hasil_ayah;
      $data->hp_ayah = $hp_ayah;
      $data->email_ayah = $email_ayah;
      $data->nama_ibu = $nama_ibu;
      $data->alamat_ibu = $alamat_ibu;
      $data->pdd_ibu = $pdd_ibu;
      $data->kerja_ibu = $kerja_ibu;
      $data->hasil_ibu = $hasil_ibu;
      $data->hp_ibu = $hp_ibu;
      $data->email_ibu = $email_ibu;
      $data->nama_wali = $nama_wali;
      $data->alamat_wali = $alamat_wali;
      $data->kerja_wali = $kerja_wali;
      $data->hp_wali = $hp_wali;
      $data->email_wali = $email_wali;
      $data->hub_wali = $hub_wali;
      $data->sdr_nama = $sdr_nama;
      $data->sdr_kelas = $sdr_kelas;
      $data->gol_darah = $gol_darah;
      $data->kond_kes = $kond_kes;
      $data->kond_obat = $kond_obat;
      $data->dokter_klg = $dokter_klg;
      $data->telp_dokter = $telp_dokter;
      $data->kode_lokasi = $kode_lokasi;
      $data->id_bank = $id_bank;

      if ($data->save()) {
        $res['message'] = "Success Mengubah Data";
        return response($res);
      }else {
        $res['message'] = "Error 404";
        return response($res);
      }

    }

    public function hapus($nis){

      $data = Sis_Siswa::where([
        ['kode_lokasi', '=', '12'],
        ['kode_pp', '=', 'yspte05'],
        ['nis', '=', $nis]
      ])->first();

      if($data->delete()){
        $res['message'] = "Success!";
        return response($res);
      }
      else{
          $res['message'] = "Failed!";
          return response($res);
      }

    }

}
