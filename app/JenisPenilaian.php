<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPenilaian extends Model
{
  protected $table = "sis_jenisnilai";
  protected $primaryKey = "kode_jenis";
  public $incrementing = false;
  public $timestamps = false;
}
