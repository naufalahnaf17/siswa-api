<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaKalender extends Model
{

  protected $table = "sis_kalender_akad";
  protected $primaryKey = "agenda";
  public $incrementing = false;
  public $timestamps = false;

}
