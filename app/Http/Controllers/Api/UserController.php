<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\MenuForm;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Sis_Siswa;

class UserController extends Controller
{

  public $successStatus = 200;

    public function login()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('Breakpoin Appliction')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $id = rand(100,10000);
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $url_photo = 'http://laravel.simkug.com/siswa-api/public/api/file/download/ML5nbHMEzI.png';
        $kode_menu = 'SISWA';
        $hash_password = bcrypt($password);

        $user = new User;
        $user->id = $id;
        $user->name = $name;
        $user->email = $email;
        $user->password = $hash_password;
        $user->url_photo = $url_photo;
        $user->kode_menu = $kode_menu;

        if ($user->save()) {
          $success['token'] =  $user->createToken('Breakpoin Appliction')->accessToken;
          $success['name'] =  $user->name;
          $success['id'] = $user->id;
          return response()->json(['success' => $success], $this->successStatus);
        }else {
          return response('gagal saat daftar');
        }

    }


    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function set_profile($id,Request $request)
    {

      $data = User::find($id);
      $data->url_photo = $request->input('url_photo');

      if ($data->save()) {
        $res['message'] = "Success Mengubah Data";
        return response($res);
      }else {
        $res['message'] = "Error 404";
        return response($res);
      }

    }

    public function menu($kode){

      if ($kode === 'SISWA') {

        $data = DB::table('menu')->where('kode_klp' , $kode)->get();

        if ($data) {
          $menu_satu = DB::table('menu')->whereBetween('kode_form' , ['F02','F03'])->get();
          $menu_dua = DB::table('menu')->whereBetween('kode_form' , ['F04','F06'])->get();
          $menu_tiga = DB::table('menu')->where('kode_klp' , '=' , 'SISWA')->whereBetween('kode_form' , ['F07','F09'])->get();

          $res['MenuSatu'] = $menu_satu;
          $res['MenuDua'] = $menu_dua;
          $res['MenuTiga'] = $menu_tiga;
          return response($res);
        }

      }

      if ($kode === 'ADM') {

        $data = DB::table('menu')->where('kode_klp' , $kode)->get();

        if ($data) {
          $admin_menu = DB::table('menu')->where('kode_klp' , '=' , 'ADM')->whereBetween('kode_form' , ['F07','F09'])->get();

          $res['AdminMenu'] = $admin_menu;
          return response($res);
        }

      }

      if ($kode === 'SEKOLAH') {

        $data = DB::table('menu')->where('kode_klp' , $kode)->get();

        if ($data) {
          $form_satu = DB::table('menu')->where('kode_klp' , '=' , 'SEKOLAH')->whereBetween('kode_form' , ['SA01','SA15'])->get();
          $form_dua = DB::table('menu')->where('kode_klp' , '=' , 'SEKOLAH')->whereBetween('kode_form' , ['SA16','SA24'])->get();
          $form_tiga = DB::table('menu')->where('kode_klp' , '=' , 'SEKOLAH')->whereBetween('kode_form' , ['SA25','SA31'])->get();

          $res['form_satu'] = $form_satu;
          $res['form_dua'] = $form_dua;
          $res['form_tiga'] = $form_tiga;
          return response($res);
        }

      }

      return response('Terjadi Kesalahan');

    }

    public function mformSiswa(){

      $data = DB::table('m_form')->get();
      $satu = DB::table('m_form')->where('form' , '=' , 'SISWA')->whereBetween('kode_form' , ['F02','F03'])->get();
      $dua = DB::table('m_form')->where('form' , '=' , 'SISWA')->whereBetween('kode_form' , ['F04','F06'])->get();
      $tiga = DB::table('m_form')->where('form' , '=' , 'SISWA')->whereBetween('kode_form' , ['F07','F09'])->get();

      if (count($data) > 0 ) {
        $res['FormSatu'] = $satu;
        $res['FormDua'] = $dua;
        $res['FormTiga'] = $tiga;

        return response($res);
      }else {
        $res['message'] = "Data Kosong";
        return response($res);
      }

    }

    public function mformAdmin(){

      $satu = DB::table('m_form')->where('form' , '=' , 'ADM')->get();

      if (count($satu) > 0 ) {
        $res['FormSatu'] = $satu;
        return response($res);
      }else {
        $res['message'] = "Data Kosong";
        return response($res);
      }

    }

    public function tambahMform(Request $request){

      $validator = Validator::make($request->all(), [
          'kode_form' => 'required',
          'nama_form' => 'required',
          'form' => 'required'
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $kode_form = $request->input('kode_form');
      $nama_form = $request->input('nama_form');
      $form = $request->input('form');
      $sts_dok = '1';


      $data = new MenuForm;
      $data->kode_form = $kode_form;
      $data->nama_form = $nama_form;
      $data->form = $form;
      $data->sts_dok = $sts_dok;

      if ($data->save()) {
        $res['message'] = "Success Menyimpan Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Menyimpan Data";
        return response($res);
      }

    }

    public function deleteMform($kode_form){

      $data = DB::table('m_form')->where('form',$kode_form)->delete();
      if($data){
        $res['message'] = "Success!";
        return response($res);
      }
      else{
          $res['message'] = "Failed!";
          return response($res);
      }

    }

    public function addDetail(Request $request){

      $data = new Sis_Siswa;
      $data->nis = $request->input('nis');
      $data->flag_aktif = $request->input('flag_aktif');
      $data->kode_kelas = $request->input('kode_kelas');
      $data->kode_akt = $request->input('kode_akt');
      $data->tgl_lulus = $request->input('tgl_lulus');
      $data->no_reg = $request->input('no_reg');
      $data->kode_ta = $request->input('kode_ta');
      $data->kode_pp = $request->input('kode_pp');
      $data->tanggal = $request->input('tanggal');
      $data->nama = $request->input('nama');

      if ($data->save()) {
        $res['message'] = "Success Menyimpan Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Menyimpan Data";
        return response($res);
      }

    }



}
