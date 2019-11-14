<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataAngkatan extends Model
{
  protected $table = "sis_angkat";
  protected $primaryKey = "kode_akt";
  public $timestamps = false;
}
