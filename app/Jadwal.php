<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
  protected $table = "sis_jadwal";
  public $timestamps = false;

  public function sis_slot()
    {
    	return $this->hasOne('App\SlotJam');
    }

}
