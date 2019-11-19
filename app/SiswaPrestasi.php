<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaPrestasi extends Model
{

  protected $table = "sis_prestasi";
  protected $primaryKey = "nis";
  public $incrementing = false;
  public $timestamps = false;

}
