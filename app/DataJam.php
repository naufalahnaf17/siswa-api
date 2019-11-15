<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataJam extends Model
{
  protected $table = "sis_slot";
  protected $primaryKey = "kode_slot";
  public $incrementing = false;
  public $timestamps = false;
}
