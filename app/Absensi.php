<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = ['pegawai_id','status', 'tgl'];


    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

}
