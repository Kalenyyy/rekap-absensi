<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'name',
        'id_siswa',
        'tanggal',
        'status',
        'emosi',
        'foto_siswa',
    ];

    public function siswa() {
        return $this->belongsTo(siswa::class, 'id_siswa', 'id');
    }
}
