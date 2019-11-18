<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaJdwlUjian extends Model
{

  protected $table = "sis_jadwal_ujian";
  protected $primaryKey = "tanggal";
  public $incrementing = false;
  public $timestamps = false;

}
