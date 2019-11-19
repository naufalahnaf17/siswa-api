<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaEkskul extends Model
{

  protected $table = "sis_ekskul";
  protected $primaryKey = "nis";
  public $incrementing = false;
  public $timestamps = false;

}
