<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
  protected $table = "sis_kelas";
  protected $primaryKey = "kode_kelas";
  public $incrementing = false;
  public $timestamps = false;
}
