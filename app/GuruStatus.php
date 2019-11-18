<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuruStatus extends Model
{

  protected $table = "sis_guru_status";
  protected $primaryKey = "kode_status";
  public $incrementing = false;
  public $timestamps = false;

}
