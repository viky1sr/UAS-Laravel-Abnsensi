<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
