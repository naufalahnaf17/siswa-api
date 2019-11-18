<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaMatpel extends Model
{

  protected $table = "sis_matpel";
  protected $primaryKey = "kode_matpel";
  public $incrementing = false;
  public $timestamps = false;

}
