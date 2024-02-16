<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asal_Sekolah extends Model
{
    // use HasFactory;
    protected $fillable = ['nama_sekolah','alamat_sekolah'];

    public function siswa(){
        return $this->hasMany(Siswa::class, 'sekolah_id' ,  'id' );
    }

}
