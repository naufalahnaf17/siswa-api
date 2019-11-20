<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlotJam extends Model
{

  protected $table = "sis_slot";

  public function sis_jadwal()
    {
    	return $this->belongsTo('App\Jadwal');
    }

}
