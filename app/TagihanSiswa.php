<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagihanSiswa extends Model
{
    protected $table = 'dev_tagihan_m';
    public $primary_key = 'no_tagihan';
    public $timestamps = false;
}
