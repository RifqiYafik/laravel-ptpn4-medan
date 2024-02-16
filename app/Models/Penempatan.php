<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'penempatan_id', 'id');
    }
}

