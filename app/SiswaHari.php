<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaHari extends Model
{

  protected $table = "sis_hari";
  protected $primaryKey = "kode_hari";
  public $incrementing = false;
  public $timestamps = false;

}
