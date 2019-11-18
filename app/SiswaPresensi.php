<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaPresensi extends Model
{

  protected $table = "sis_presensi";
  protected $primaryKey = "nis";
  public $incrementing = false;
  public $timestamps = false;

}
