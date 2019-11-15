<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
          $res['error'] = "Token Belum Dimasukan , Harap Masukan Token Pada Header Postman / Http Request Mu";
          $res['message'] = "You Should Insert Your Token Into Header Option In Postman On GuzzleHttp";
          $res['format-input'] = "Bearer *insert Your Token Here";
          $res['example'] = "Bearer abcdefghijklmnopqxxxx";
          return response($res,403);
        }
    }
}
