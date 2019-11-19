<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaRaport extends Model
{

  protected $table = "sis_raport_m";
  protected $primaryKey = "nis";
  public $incrementing = false;
  public $timestamps = false;

  protected $fillable = [
    'no_bukti','kode_ta','kode_sem','kode_kelas','nis','kode_pp','kode_lokasi'
  ];

}
