<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model {
    protected $table = 'akuns';
    protected $fillable = ['id', 'nama_mahasiswa', 'jurusan', 'email'];
}
