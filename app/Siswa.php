<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = "siswa";

    public function kode_form(){
      return $this->hasOne('App\MenuForm');
    }

}
