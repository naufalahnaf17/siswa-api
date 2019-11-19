<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaEkskul extends Model
{

  protected $table = "sis_ekskul";
  protected $primaryKey = "kode_hari";
  public $incrementing = false;
  public $timestamps = false;

}
