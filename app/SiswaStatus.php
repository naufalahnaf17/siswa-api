<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaStatus extends Model
{
  protected $table = "sis_siswa_status";
  protected $primaryKey = "kode_ss";
  public $incrementing = false;
  public $timestamps = false;
}
