<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaNilai extends Model
{

  protected $table = "sis_nilai";
  protected $primaryKey = "nis";
  public $incrementing = false;
  public $timestamps = false;

}
