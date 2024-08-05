<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'foto', 'kelas', 'absen'];

    public function pasiens()
    {
        return $this->hasMany(Pasien::class, 'siswa_id');
    }
}
