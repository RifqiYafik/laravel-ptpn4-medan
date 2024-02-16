<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    // use HasFactory;
    // Di dalam model Siswa
    protected $fillable = ['nama_siswa', 'id_siswa', 'tmpt_lahir', 'tgl_lahir', 'jenis_kelamin', 'alamat', 'sekolah_id', 'penempatan_id', 'tgl_masuk', 'tgl_keluar', 'no_hp', 'image'];


    public function asal_sekolah(){
        return $this->hasOne(Asal_Sekolah::class, 'id', 'sekolah_id');
    }


    public function penempatan(){
        return $this->hasOne(Penempatan::class,  'id' , 'penempatan_id');
    }
}
