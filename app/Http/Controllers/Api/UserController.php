<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\MenuForm;
use Validator;
use Illuminate\Support\Facades\DB;

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

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] =  $user->createToken('Breakpoin Appliction')->accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success' => $success], $this->successStatus);
    }


    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
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
          $res['Semua'] = $data;
          return response($res);
        }

      }

      if ($kode === 'ADM') {

        $data = DB::table('menu')->where('kode_klp' , $kode)->get();

        if ($data) {
          $admin_menu = DB::table('menu')->where('kode_klp' , '=' , 'ADM')->whereBetween('kode_form' , ['F07','F09'])->get();

          $res['AdminMenu'] = $admin_menu;
          $res['Semua'] = $data;
          return response($res);
        }

      }

      return response('Terjadi Kesalahan');

    }

    public function mform(){
      $data = MenuForm::all();
      return response()->json($data);
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

      $data = MenuForm::where('kode_form',$kode_form)->get();
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
