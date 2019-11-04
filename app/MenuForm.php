<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuForm extends Model
{
    protected $table = "m_form";
    public $timestamps = false;

    public function nama_form(){
        return $this->belongsTo('App\Siswa');
    }

}
