<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sis_Jur extends Model
{
  protected $table = "sis_jur";
  protected $primaryKey = "kode_jur";
  public $incrementing = false;
  public $timestamps = false;
}
