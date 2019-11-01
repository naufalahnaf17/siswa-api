<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
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
      $data = DB::table('m_form')->get();
      return response()->json($data);
    }


}
