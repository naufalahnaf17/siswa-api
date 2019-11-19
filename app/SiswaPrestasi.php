<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaPrestasi extends Model
{

  protected $table = "sis_prestasi";
  protected $primaryKey = "nis";
  public $incrementing = false;
  public $timestamps = false;

  protected $fillable = [
      'no_bukti', 'nik_user', 'tgl_input','nis','tanggal','keterangan','tempat','kode_kategori','jenis','kode_lokasi','kode_pp'
  ];

}
