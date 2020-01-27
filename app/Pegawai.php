<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = ['nama_pegawai','jabatan_id', 'jk', 'no_telp', 'alamat'];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function absensi()
    {
        return $this->hasOne(Order::class);
    }
}
