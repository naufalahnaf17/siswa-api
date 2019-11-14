<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
  protected $table = "sis_ta";
  protected $primaryKey = "kode_ta";
  public $timestamps = false;
}
