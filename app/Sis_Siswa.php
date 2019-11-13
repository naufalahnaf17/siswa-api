<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sis_Siswa extends Model
{
    protected $table = "sis_siswa";
    protected $primaryKey = "nis";
    public $timestamps = false;
}
