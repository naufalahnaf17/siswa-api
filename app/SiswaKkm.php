<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaKkm extends Model
{

  protected $table = "sis_kkm";
  protected $primaryKey = "kode_matpel";
  public $incrementing = false;
  public $timestamps = false;

}
